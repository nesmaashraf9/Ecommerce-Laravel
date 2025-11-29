<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use PDF;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Total Orders
        $totalOrders = Order::count();
        
        // Total Revenue (sum of all order totals)
        $totalRevenue = Order::sum('total');
        
        // Pending Orders
        $pendingOrders = Order::where('delivery_status', 'pending')->count();
        
        // Delivered Orders
        $deliveredOrders = Order::where('delivery_status', 'delivered')->count();
        
        // Recent Orders
        $recentOrders = Order::with('user')
            ->latest()
            ->take(5)
            ->get();
            
        // Total Products
        $totalProducts = Product::count();
        
        // Total Customers (users who are not admins)
        $totalCustomers = User::where('usertype', '0')->count();
        
        // Return the admin.home view which includes admin.body
        return view('admin.home', [
            'totalOrders' => $totalOrders,
            'totalRevenue' => $totalRevenue,
            'pendingOrders' => $pendingOrders,
            'deliveredOrders' => $deliveredOrders,
            'recentOrders' => $recentOrders,
            'totalProducts' => $totalProducts,
            'totalCustomers' => $totalCustomers
        ]);
    }
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the customers.
     *
     * @return \Illuminate\Http\Response
     */
    public function customers()
    {
        $customers = User::where('usertype', '0')->latest()->paginate(10);
        return view('admin.customers.index', compact('customers'));
    }

    public function view_category()
    {
        $data = Category::all();
        return view('admin.category', compact('data'));
    }

    public function add_category(Request $request)
    {
        $request->validate([
            'category_name' => 'required|unique:categories|max:255',
        ]);

        Category::create([
            'category_name' => $request->category_name,
        ]);

        return redirect()->back()->with('message', 'Category Added Successfully');
    }

    public function delete_category($id)
    {
        $data = Category::find($id);
        if ($data) {
            $data->delete();
            return redirect()->back()->with('message', 'Category deleted successfully');
        }
        return redirect()->back()->with('error', 'Category not found!');
    }

    public function orders(Request $request)
    {
        $query = Order::with(['user', 'items'])
            ->latest();
        
        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('id', 'like', "%{$search}%")
                  ->orWhere('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }
        
        // Filter by status
        if ($request->has('status') && !empty($request->status)) {
            $query->where('delivery_status', $request->status);
        }
        
        $orders = $query->paginate(10)->withQueryString();
            
        // Check if payment_status column exists before trying to update it
        $orders->each(function($order) {
            if ($order->payment_id && !$order->delivery_status) {
                $order->delivery_status = 'processing';
                $order->save();
            }
        });
            
        return view('admin.orders', compact('orders'));
    }

    public function orderDetails($id)
    {
        // First, get the order with relationships
        $order = Order::with(['user', 'items.product'])->findOrFail($id);
        
        // Calculate subtotal from items
        $subtotal = $order->items->sum(function($item) {
            return $item->price * $item->quantity;
        });
        
        // Set the calculated values
        $order->subtotal = $order->subtotal ?? $subtotal;
        $order->shipping = $order->shipping ?? 0;
        $order->tax = $order->tax ?? 0;
        $order->total = $order->total ?? ($order->subtotal + $order->shipping + $order->tax);
        
        // Set default status if not set
        $order->delivery_status = $order->delivery_status ?? 'pending';
        $order->payment_status = $order->payment_status ?? ($order->payment_id ? 'paid' : 'pending');
        
        return view('admin.order-details', compact('order'));
    }

    public function updateOrderStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        
        if ($request->status === 'delivered') {
            $order->delivery_status = 'delivered';
            $order->status = 'completed';
            $order->save();
            
            return redirect()->back()->with('message', 'Order marked as delivered successfully!');
        }
        
        return redirect()->back()->with('error', 'Invalid status update');
    }

    /**
     * Export orders to PDF
     */
    public function exportPdf()
    {
        $orders = Order::with(['user', 'items'])
            ->latest()
            ->get();
        
        // Add a computed payment_status property to each order based on the same logic as the website
        $orders->each(function($order) {
            if ($order->status === 'completed') {
                $order->payment_status = 'paid';
            } elseif ($order->status === 'processing') {
                $order->payment_status = 'processing';
            } elseif ($order->status === 'cancelled') {
                $order->payment_status = 'cancelled';
            } else {
                $order->payment_status = $order->payment_id ? 'paid' : 'pending';
            }
        });
        
        $pdf = PDF::loadView('admin.pdf.orders', compact('orders'));
        
        // Set paper size and orientation
        $pdf->setPaper('A4', 'landscape');
        
        // Download the PDF file with a dynamic filename
        return $pdf->download('orders-' . now()->format('Y-m-d') . '.pdf');
    }

    /**
     * Export single order to PDF
     */
    public function exportOrderPdf($id)
    {
        $order = Order::with(['user', 'items.product'])->findOrFail($id);
        
        // Calculate subtotal from items
        $subtotal = $order->items->sum(function($item) {
            return $item->price * $item->quantity;
        });
        
        // Set the calculated values
        $order->subtotal = $order->subtotal ?? $subtotal;
        $order->shipping = $order->shipping ?? 0;
        $order->tax = $order->tax ?? 0;
        $order->total = $order->total ?? ($order->subtotal + $order->shipping + $order->tax);
        
        // Set default status if not set
        $order->delivery_status = $order->delivery_status ?? 'pending';
        $order->payment_status = $order->status;
        
        $pdf = PDF::loadView('admin.pdf.order-details', compact('order'));
        
        // Set paper size and orientation
        $pdf->setPaper('A4');
        
        // Download the PDF file with a dynamic filename
        return $pdf->download('order-' . $order->id . '-' . now()->format('Y-m-d') . '.pdf');
    }
}
