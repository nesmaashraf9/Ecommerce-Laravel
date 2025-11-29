<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function __construct()
    {
    $this->middleware('auth');
}
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('home.cart', compact('cart'));
    }

    // In your CartController or relevant controller
    public function addToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $quantity = $request->input('quantity', 1);
        
        // Check if product is in stock
        if ($product->quantity < $quantity) {
            return redirect()->back()->with('error', 'Not enough stock available');
        }
        
        $cart = session()->get('cart', []);
        
        if(isset($cart[$id])) {
            $newQuantity = $cart[$id]['quantity'] + $quantity;
            if ($newQuantity > $product->quantity) {
                return redirect()->back()->with('error', 'Not enough stock available');
            }
            $cart[$id]['quantity'] = $newQuantity;
        } else {
            $cart[$id] = [
                "name" => $product->title,
                "quantity" => $quantity,
                "price" => $product->discount_price ?: $product->price,
                "image" => $product->image
            ];
        }
        
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart');
    }

    public function updateCart(Request $request)
    {
        $id = $request->id;
        $cart = session()->get('cart', []);

        if (!isset($cart[$id])) {
            return response()->json(['message' => 'Item not found in cart.'], 404);
        }

        $product = \App\Models\Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found.'], 404);
        }

        $maxQty = $product->quantity;

        if ($request->change_quantity == 'increase' && $cart[$id]['quantity'] < $maxQty) {
            $cart[$id]['quantity']++;
        } elseif ($request->change_quantity == 'decrease' && $cart[$id]['quantity'] > 1) {
            $cart[$id]['quantity']--;
        } elseif ($request->has('quantity')) {
            $newQty = intval($request->quantity);
            $cart[$id]['quantity'] = max(1, min($newQty, $maxQty));
        }

        session()->put('cart', $cart);

        // احسبي الإجمالي بعد التحديث
        $subtotal = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        $cartCount = count($cart);

        // لو الطلب AJAX نرجّع JSON
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'cart_count' => $cartCount,
                'subtotal' => number_format($subtotal, 2),
                'message' => 'Cart updated successfully.'
            ]);
        }

        // لو مش AJAX نرجّع Redirect عادي
        return redirect()->back()->with('success', 'Cart updated successfully!');
    }
        public function removeFromCart(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }
    public function getCartCount()
{
    $cart = session()->get('cart', []);
    return response()->json(['count' => count($cart)]);
}
}
