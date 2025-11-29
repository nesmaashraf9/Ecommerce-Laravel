<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, Product $product)
{
    $request->validate([
        'rating' => 'required|integer|min:1|max:5',
        'comment' => 'required|string|max:1000',
    ]);

    // Check if user is authenticated
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Please login to submit a review.');
    }

    // Check if user has already reviewed this product
    $existingReview = Review::where('user_id', Auth::id())
                            ->where('product_id', $product->id)
                            ->first();

    if ($existingReview) {
        return redirect()->back()->with('error', 'You have already reviewed this product.');
    }

    // Create new review (auto use logged-in user name)
    $review = new Review([
        'user_id' => Auth::id(),
        'user_name' => Auth::user()->name,
        'rating' => $request->rating,
        'comment' => $request->comment,
    ]);

    $product->reviews()->save($review);

    return redirect()->back()->with('success', 'Thank you for your review!');
}


    public function index(Product $product)
    {
        $reviews = $product->reviews()
                         ->with('user')
                         ->latest()
                         ->paginate(5);

        return response()->json([
            'reviews' => $reviews,
            'average_rating' => number_format($product->averageRating(), 1),
            'rating_count' => $product->rating_count,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
