<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

   
    public function create()
    {
        $category = Category::all();
        return view('admin.product.create',compact('category'));
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
        
        $imagePath = $request->file('image')->store(path: 'public/products');
        $imageUrl = str_replace('public', '/', $imagePath);

        $product = new Product();
        $product->name = $validated['name'];
        $product->price = $validated['price'];
        $product->image = $imageUrl; 
        $product->category_id = $request->category_id; 
        $product->description = $request->description; 
        $product->user_id = auth()->user()->id;
        $product->save();
       

        return redirect()->route('admin.product');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.product.edit', compact('product','categories'));
    }
  
    
    // Update the product in the database
    public function update(Request $request, Product $product)
    {
        $product->name = $request->name;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store(path: 'public/products');
            $imageUrl = str_replace('public', '/', $imagePath); 
    
            $product->image = $imageUrl; // Save the image URL to the product
        }
        $product->save();
        return redirect()->route('admin.product')->with('success', 'Product updated successfully.');
    }
    

    // Delete a product from the database
    public function destroy(Product $product)
    {
        // Delete product image from storage
        if ($product->image) {
            Storage::delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.product')->with('success', 'Product deleted successfully.');
    }

   
}
