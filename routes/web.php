<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\BlogController;

// Public routes
Route::get('/', [HomeController::class, 'index']);

// Comments routes
Route::prefix('comments')->group(function () {
    Route::get('/', [CommentController::class, 'index']);
    Route::post('/', [CommentController::class, 'store']);
    Route::get('/{id}', [CommentController::class, 'show']);
    Route::put('/{id}', [CommentController::class, 'update']);
    Route::delete('/{id}', [CommentController::class, 'destroy']);
    Route::post('/{commentId}/replies', [CommentController::class, 'storeReply']);
});

// Reviews routes
Route::prefix('products/{product}/reviews')->group(function () {
    Route::get('/', [App\Http\Controllers\ReviewController::class, 'index'])->name('reviews.index');
    Route::post('/', [App\Http\Controllers\ReviewController::class, 'store'])->name('reviews.store');
});
Route::get('/all-products', [HomeController::class, 'allProducts'])->name('all.products');
Route::get('/product/details/{id}', [HomeController::class, 'productDetails'])->name('product.details');

// Blog routes
Route::prefix('blog')->name('blog.')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('index');
    Route::get('/category/{category}', [BlogController::class, 'category'])->name('category');
    Route::get('/{slug}', [BlogController::class, 'show'])->name('show');
});

// Authentication routes with email verification

// Email verification notice
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

// Authenticated routes (require email verification)
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // User Orders
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/orders', [App\Http\Controllers\UserController::class, 'orders'])->name('orders');
        Route::get('/orders/{id}', [App\Http\Controllers\UserController::class, 'showOrder'])->name('orders.show');
        Route::patch('/orders/{id}/cancel', [App\Http\Controllers\UserController::class, 'cancelOrder'])->name('orders.cancel');
    });

    // Redirect after login
    Route::get('/redirect', [HomeController::class, 'redirect'])->middleware('auth', 'verified');

    // Cart routes
    Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart');
    Route::post('/add-to-cart/{id}', [App\Http\Controllers\CartController::class, 'addToCart'])->name('add.to.cart');
    Route::patch('/update-cart', [App\Http\Controllers\CartController::class, 'updateCart'])->name('update.cart');
    Route::delete('/remove-from-cart', [App\Http\Controllers\CartController::class, 'removeFromCart'])->name('remove.from.cart');
    Route::get('/cart/count', [App\Http\Controllers\CartController::class, 'getCartCount'])->name('cart.count');

    // Checkout routes
    Route::get('/checkout', [App\Http\Controllers\CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout', [App\Http\Controllers\CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/order-confirmation/{id}', [App\Http\Controllers\CheckoutController::class, 'confirmation'])->name('order.confirmation');

    // Stripe payment routes
    Route::get('/stripe-payment', [StripePaymentController::class, 'showStripeForm'])->name('stripe.payment');
    Route::post('/process-stripe-payment', [StripePaymentController::class, 'processStripePayment'])->name('process.stripe.payment');
});

// Admin routes
Route::prefix('admin')->middleware(['auth', 'verified', 'admin'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Orders
    Route::get('/orders', [AdminController::class, 'orders'])->name('admin.orders');
    
    // Customers
    
});

// Product routes (available to all authenticated users)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

    Route::get('/customers', [AdminController::class, 'customers'])->name('admin.customers');


    // Category routes
    Route::get('/categories', [AdminController::class, 'view_category'])->name('categories.index');
    Route::get('/categories/create', [AdminController::class, 'create_category'])->name('categories.create');
    Route::post('/categories', [AdminController::class, 'add_category'])->name('categories.store');
    Route::get('/categories/{id}/edit', [AdminController::class, 'edit_category'])->name('categories.edit');
    Route::put('/categories/{id}', [AdminController::class, 'update_category'])->name('categories.update');
    Route::delete('/categories/{id}', [AdminController::class, 'delete_category'])->name('categories.destroy');


    Route::get('/orders', [AdminController::class, 'orders'])->name('orders');
    Route::get('/orders/export-pdf', [AdminController::class, 'exportPdf'])->name('orders.export.pdf');
    Route::get('/orders/{id}/export-pdf', [AdminController::class, 'exportOrderPdf'])->name('order.export.pdf');
    Route::get('/orders/{id}', [AdminController::class, 'orderDetails'])->name('order.details');
    Route::post('/orders/{id}/update-status', [AdminController::class, 'updateOrderStatus'])->name('order.update-status');
});

