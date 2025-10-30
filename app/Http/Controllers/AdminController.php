<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
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

    public function orders()
    {
        $orders = Order::with(['user', 'items'])
            ->latest()
            ->paginate(10);
            
        // Update payment status for each order if not set
        foreach ($orders as $order) {
            if (empty($order->payment_status)) {
                $order->payment_status = $order->payment_id ? 'paid' : 'pending';
                $order->save();
            }
        }
            
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
}
