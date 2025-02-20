<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Auth;
class frontendController extends Controller
{
    public function index(){
        $categories = Category::all();
        $product = Product::with('user','category')->get();
        return view('dashboard',compact('product','categories'));
    }
    public function search(Request $request)
    {
        $query = Product::query();

        // Search by product name
        if ($request->has('productName') && $request->productName != '') {
            $query->where('name', 'like', '%' . $request->productName . '%');
        }

        // Filter by category
        if ($request->has('categoryId') && $request->categoryId != '') {
            $query->where('category_id', $request->categoryId);
        }

        // Get the filtered products
        $products = $query->get();

        // Return the updated table rows as a response
        return view('products.product_rows', compact('products'))->render();
    }
    public function create()
    {
        $category = Category::all();
        return view('products.create',compact('category'));
    }

    // Store a newly created product
    public function store(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
        ]);

        // Combine width and height into a single JSON object
        
        $image = $request->file('image');
        $imageName = time().'.'.$image->getClientOriginalExtension();
        $image->move(public_path('products'), $imageName);

        $product = new Product();
        $product->name = $validated['name'];
        $product->price = $validated['price'];
        $product->image = $imageName; 
        $product->category_id = $request->category_id; 
        $product->description = $request->description; 
        $product->user_id = auth()->user()->id;
        $product->save();
       

        return redirect()->route('dashboard');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product','categories'));
    }
  
    
    // Update the product in the database
    public function update(Request $request, Product $product)
    {
        $product->name = $request->name;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('products'), $imageName);
            $product->image = $imageName; // Save the image URL to the product
        }
        $product->save();
        return redirect()->route('dashboard')->with('success', 'Product updated successfully.');
    }
    public function destroy(Product $product)
    {
        // Find the product by ID
        if ($product->image && file_exists(public_path('products/'.$product->image))) {
            unlink(public_path('products/'.$product->image));
        }
        $product->delete();
        return redirect()->route('dashboard')->with('success', 'Product deleted successfully');
    }
}
