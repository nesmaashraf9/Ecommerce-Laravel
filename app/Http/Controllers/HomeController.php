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
            return view('admin.home');
        } else {
            // Make sure to use pagination here too if needed
            $products = Product::where('quantity', '>', 0)
                             ->orderBy('created_at', 'desc')
                             ->paginate(3);
            return view('home.userpage', compact('products'));
        }
    }

    public function allProducts()
    {
        $products = Product::where('quantity', '>', 0)
                         ->orderBy('created_at', 'desc')
                         ->paginate(12); // Show 12 products per page with pagination
        
        return view('home.all_products', compact('products'));
    }
    public function productDetails($id)
{
    $product = Product::findOrFail($id);
    return view('home.product_details', compact('product'));
}
}