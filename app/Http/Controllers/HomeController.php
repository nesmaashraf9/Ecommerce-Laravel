<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::where('quantity', '>', 0)
                         ->orderBy('created_at', 'desc')
                         ->paginate(3); // Show 3 products per page with pagination
        
        return view('home.userpage', compact('products'));
    }

    public function redirect()
    {
        $usertype = Auth::user()->usertype;

        if($usertype == '1') {
            // Redirect to the dashboard URL directly instead of using named route
            return redirect('/dashboard');
        } else {
            // Make sure to use pagination here too if needed
            $products = Product::where('quantity', '>', 0)
                             ->orderBy('created_at', 'desc')
                             ->paginate(3);
            return view('home.userpage', compact('products'));
        }
    }

    public function allProducts(Request $request)
    {
        $search = $request->input('search');
        
        $query = Product::query();
        
        if ($search) {
            $query->where('title', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%")
                ->orWhere('category_name', 'like', "%{$search}%");
        }
        
        $products = $query->paginate(12);
        
        if ($request->ajax()) {
            $view = view('home.partials._products', compact('products'))->render();
            $pagination = $products->links('pagination::bootstrap-4')->toHtml();
            
            return response()->json([
                'html' => $view,
                'pagination' => $pagination
            ]);
        }
        
        return view('home.all_products', compact('products'));
    }
    public function productDetails($id)
    {
        // Load the product with its reviews and category
        $product = Product::with(['reviews.user', 'category'])->findOrFail($id);
        
        // Get related products (products from the same category, excluding the current product)
        $relatedProducts = Product::where('category_id', $product->category_id)
                                 ->where('id', '!=', $product->id)
                                 ->where('quantity', '>', 0)
                                 ->inRandomOrder()
                                 ->limit(4) // Show 4 related products
                                 ->get();
        
        // Calculate rating counts for the rating bars
        $ratingCounts = [];
        for ($i = 1; $i <= 5; $i++) {
            $ratingCounts[$i] = $product->reviews->where('rating', $i)->count();
        }
        
        return view('home.product_details', [
            'product' => $product,
            'relatedProducts' => $relatedProducts,
            'ratingCounts' => $ratingCounts
        ]);
    }
}