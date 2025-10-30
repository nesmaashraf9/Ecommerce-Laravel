<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;

Route::get('/', [HomeController::class, 'index']);
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
Route::get('/redirect', [HomeController::class, 'redirect']);

Route::get('/view_category', [AdminController::class, 'view_category']);
Route::get('/orders', [AdminController::class, 'orders'])->name('admin.orders');
Route::get('/order/{id}', [AdminController::class, 'orderDetails'])->name('admin.order.details');
Route::post('/order/{id}/update-status', [AdminController::class, 'updateOrderStatus'])->name('admin.order.update-status');

Route::post('/add_category', [AdminController::class, 'add_category'])->name('add_category');
Route::delete('/delete_category/{id}', [AdminController::class, 'delete_category'])->name('delete_category');

Route::get('/view_product', [ProductController::class, 'index'])->name('products.index');
Route::get('/add_product', [ProductController::class, 'create'])->name('products.create');
Route::post('/add_product', [ProductController::class, 'store'])->name('products.store');
Route::delete('/delete_product/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
Route::get('/edit_product/{id}', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/update_product/{id}', [ProductController::class, 'update'])->name('products.update');
Route::get('/products', [HomeController::class, 'allProducts'])->name('all.products');
Route::get('/product/details/{id}', [HomeController::class, 'productDetails'])->name('product.details');

// Stripe Routes
Route::get('/stripe-payment', [StripePaymentController::class, 'showStripeForm'])->name('stripe.payment');
Route::post('/process-stripe-payment', [StripePaymentController::class, 'processStripePayment'])->name('process.stripe.payment');

// Cart Routes
Route::middleware(['auth'])->group(function () {
    Route::post('/add-to-cart/{id}', [App\Http\Controllers\CartController::class, 'addToCart'])->name('add.to.cart');
    Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart');
    Route::patch('/update-cart', [App\Http\Controllers\CartController::class, 'updateCart'])->name('update.cart');
    Route::delete('/remove-from-cart', [App\Http\Controllers\CartController::class, 'removeFromCart'])->name('remove.from.cart');
});
// Add this to your web.php routes
Route::get('/cart/count', [App\Http\Controllers\CartController::class, 'getCartCount'])->name('cart.count');

// Checkout Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/checkout', [App\Http\Controllers\CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout', [App\Http\Controllers\CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/order-confirmation/{id}', [App\Http\Controllers\CheckoutController::class, 'confirmation'])->name('order.confirmation');
});
