<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class UserController extends Controller
{
    public function orders()
    {
        $orders = Auth::user()->orders()
            ->with(['items', 'items.product'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('home.orders', compact('orders'));
    }

    public function cancelOrder(Request $request, $id)
    {
        $order = Order::where('user_id', Auth::id())->findOrFail($id);
        
        // Check if order can be cancelled (e.g., not already shipped or cancelled)
        if (in_array($order->status, ['pending', 'processing'])) {
            $order->update(['status' => 'cancelled']);
            return redirect()->back()->with('success', 'Order has been cancelled successfully.');
        }
        
        return redirect()->back()->with('error', 'This order cannot be cancelled.');
    }
}
