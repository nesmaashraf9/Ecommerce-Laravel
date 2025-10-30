<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class CheckoutController extends Controller
{
    public function index()
    {
        // Get the cart from the session
        $cart = session()->get('cart', []);
        
        // If cart is empty, redirect to cart page with a message
        if (empty($cart)) {
            return redirect()->route('cart')
                ->with('error', 'Your cart is empty. Please add some products before checkout.');
        }
        
        // Calculate cart totals
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        
        $tax = $subtotal * 0.15; // 15% tax
        $shipping = 10.00; // Flat rate shipping
        $total = $subtotal + $tax + $shipping;
        
        // Get user details if logged in
        $user = Auth::user();
        
        return view('home.checkout', compact('cart', 'subtotal', 'tax', 'shipping', 'total', 'user'));
    }
    
    public function store(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'zip_code' => 'required|string|max:20',
            'country' => 'required|string|max:100',
            'notes' => 'nullable|string',
        ]);
        
        // Get cart from session
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart')
                ->with('error', 'Your cart is empty. Please add some products before checkout.');
        }
        
        // Calculate totals
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        
        $tax = $subtotal * 0.15; // 15% tax
        $shipping = 10.00; // Flat rate shipping
        $total = $subtotal + $tax + $shipping;
        
        // Start database transaction
        DB::beginTransaction();
        
        try {
            // Create the order
            $order = Order::create([
                'user_id' => Auth::id(),
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'address' => $validated['address'],
                'city' => $validated['city'],
                'state' => $validated['state'],
                'zip_code' => $validated['zip_code'],
                'country' => $validated['country'],
                'subtotal' => $subtotal,
                'tax' => $tax,
                'shipping' => $shipping,
                'total' => $total,
                'status' => 'pending',
                'notes' => $validated['notes'] ?? null,
            ]);
            
            // Create order items
            foreach ($cart as $id => $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $id,
                    'product_name' => $item['name'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'subtotal' => $item['price'] * $item['quantity'],
                ]);
            }
            
            // Commit the transaction
            DB::commit();
            
            // Clear the cart
            session()->forget('cart');
            
            // Redirect to order confirmation page
            return redirect()->route('order.confirmation', $order->id)
                ->with('success', 'Your order has been placed successfully!');
                
        } catch (\Exception $e) {
            // Rollback the transaction in case of error
            DB::rollBack();
            
            return redirect()->back()
                ->with('error', 'An error occurred while processing your order. Please try again.')
                ->withInput();
        }
    }
    
    public function confirmation($id)
    {
        $order = Order::with('items')->findOrFail($id);
        
        // Verify that the order belongs to the authenticated user
        if (Auth::id() !== $order->user_id) {
            abort(403);
        }
        
        return view('home.order-confirmation', compact('order'));
    }
}
