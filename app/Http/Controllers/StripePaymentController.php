<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Customer;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Session;

class StripePaymentController extends Controller
{
    public function showStripeForm()
    {
        return view('home.stripe');
    }

    public function processStripePayment(Request $request)
    {
        try {
            // Validate the request
            $validated = $request->validate([
                'stripeToken' => 'required',
                'amount' => 'required|numeric|min:1',
                'email' => 'required|email',
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'address' => 'required|string|max:255',
                'city' => 'required|string|max:100',
                'state' => 'required|string|max:100',
                'zip_code' => 'required|string|max:20',
                'country' => 'required|string|max:100',
            ]);

            Stripe::setApiKey(env('STRIPE_SECRET'));

            // Create a customer in Stripe
            $customer = Customer::create([
                'email' => $validated['email'],
                'name' => $validated['first_name'] . ' ' . $validated['last_name'],
                'phone' => $validated['phone'],
                'source' => $validated['stripeToken'],
                'address' => [
                    'line1' => $validated['address'],
                    'city' => $validated['city'],
                    'state' => $validated['state'],
                    'postal_code' => $validated['zip_code'],
                    'country' => $validated['country'],
                ]
            ]);

            // Create a charge
            $charge = Charge::create([
                'customer' => $customer->id,
                'amount' => $validated['amount'] * 100, // Convert to cents
                'currency' => 'usd',
                'description' => 'Order payment from ' . $validated['first_name'] . ' ' . $validated['last_name'],
                'metadata' => [
                    'order_type' => 'ecommerce',
                    'customer_name' => $validated['first_name'] . ' ' . $validated['last_name']
                ]
            ]);

            // Save order to database
            $order = new Order();
            $order->user_id = Auth::id();
            $order->payment_id = $charge->id;
            $order->first_name = $validated['first_name'];
            $order->last_name = $validated['last_name'];
            $order->email = $validated['email'];
            $order->phone = $validated['phone'];
            $order->address = $validated['address'];
            $order->city = $validated['city'];
            $order->state = $validated['state'];
            $order->zip_code = $validated['zip_code'];
            $order->country = $validated['country'];
            
            // Get cart items once
            $cart = Session::get('cart', []);
            
            // Calculate subtotal from cart items
            $subtotal = 0;
            foreach ($cart as $item) {
                $subtotal += $item['price'] * $item['quantity'];
            }
            
            // Set order amounts
            $order->subtotal = $subtotal;
            $order->tax = $subtotal * 0.1; // 10% tax
            $order->shipping = 10.00; // Flat rate shipping
            $order->total = $validated['amount'];
            $order->status = 'completed';
            
            // Start a database transaction
            \DB::beginTransaction();
            
            try {
                $order->save();

                // Create order items
                foreach ($cart as $id => $item) {
                    $order->items()->create([
                        'product_id' => $id,
                        'product_name' => $item['name'] ?? 'Product ' . $id,
                        'price' => $item['price'],
                        'quantity' => $item['quantity'],
                        'subtotal' => $item['price'] * $item['quantity']
                    ]);
                }
                
                // Commit the transaction
                \DB::commit();
            } catch (\Exception $e) {
                // Rollback the transaction on error
                \DB::rollBack();
                throw $e;
            }

            // Clear cart
            Session::forget('cart');

            // Return success response
            return response()->json([
                'success' => true,
                'message' => 'Payment successful!',
                'order_id' => $order->id,
                'redirect' => route('order.confirmation', ['id' => $order->id])
            ]);
            
        } catch (\Exception $e) {
            \Log::error('Stripe Payment Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}