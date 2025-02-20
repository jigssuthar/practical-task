<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Payment;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Support\Facades\Crypt;

class BackendController extends Controller
{
    public function category(){
        $categories = Category::all();
        return view('admin.category.categoryview',compact('categories'));
    }
   

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        $category = Category::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        return response()->json($category, 201);
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        $category->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        return response()->json($category, 200);
    }

 

}
