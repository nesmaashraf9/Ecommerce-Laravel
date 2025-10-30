<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all(); // Remove the with('category') since we're not using it anymore
        $categories = Category::all();
        return view('admin.products.index', compact('products', 'categories'));
    }
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|exists:categories,id',
            'quantity' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0|lt:price',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $category = Category::findOrFail($request->category);
    
        $imageName = time().'.'.$request->image->extension();  
        $request->image->move(public_path('product'), $imageName);
    
        Product::create([
            'title' => $request->title,
            'description' => $request->description,
            'category_name' => $category->category_name,
            'category_id' => $category->id,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'discount_price' => $request->discount_price,
            'image' => $imageName,
        ]);
    
        return redirect()->route('products.index')->with('message', 'Product added successfully!');
    }
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if(file_exists(public_path('product/'.$product->image))) {
            unlink(public_path('product/'.$product->image));
        }
        $product->delete();
        
        return redirect()->back()->with('message', 'Product deleted successfully!');
    }

    public function edit($id)
{
    $product = Product::findOrFail($id);
    $categories = Category::all();
    return view('admin.products.edit', compact('product', 'categories'));
}

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|exists:categories,id',
            'quantity' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0|lt:price',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = Product::findOrFail($id);
        $category = Category::findOrFail($request->category);

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'category_name' => $category->category_name,
            'category_id' => $category->id,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'discount_price' => $request->discount_price,
        ];

        // Handle image upload if a new image is provided
        if ($request->hasFile('image')) {
            // Delete old image
            if (file_exists(public_path('product/'.$product->image))) {
                unlink(public_path('product/'.$product->image));
            }
            
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('product'), $imageName);
            $data['image'] = $imageName;
        }

        $product->update($data);

        return redirect()->route('products.index')->with('message', 'Product updated successfully!');
    }

    
}