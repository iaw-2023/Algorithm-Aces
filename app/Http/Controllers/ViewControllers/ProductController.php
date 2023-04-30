<?php

namespace App\Http\Controllers\ViewControllers;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('ProductViews.products',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('ProductViews.product-create',compact('categories','brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|regex:/^[a-zA-Z0-9]{1,35}$/|unique:products',
            'image' => 'required|url',
            'size' => 'required|regex:/^[a-zA-Z0-9]{1,20}$/',
            'price' => 'required|regex:/^\d{1,5}\.\d{2}$/',
            'stock' => 'required|integer|min:1|max:9999',
            'brand_id' => 'required|exists:brands,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product = Product::create([
            'name' => $validatedData['name'],
            'image' => $validatedData['image'],
            'size' => $validatedData['size'],
            'price' => $validatedData['price'],
            'stock' => $validatedData['stock'],
            'brand_id' => $validatedData['brand_id'],
            'category_id' => $validatedData['category_id'],
        ]);

        return redirect()->route('product.index')
            ->with('success', 'Product created successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('ProductViews.product-edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|regex:/^[a-zA-Z0-9]{1,35}$/|unique:products,name,'.$id,
            'image' => 'required|url',
            'size' => 'required|regex:/^[a-zA-Z0-9]{1,20}$/',
            'price' => 'required|regex:/^\d{1,5}\.\d{2}$/',
            'stock' => 'required|integer|min:1|max:9999',
            'brand_id' => 'required|exists:brands,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product = Product::findOrFail($id);
        $product->update($validatedData);

        return redirect()->route('product.index')
            ->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
