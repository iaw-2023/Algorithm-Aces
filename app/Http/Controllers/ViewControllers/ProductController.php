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
        $validatedData = $request->validate(Product::$rules);
        Product::create($validatedData);

        return redirect()->route('products.index')
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
    {   $categories = Category::all();
        $brands = Brand::all();
        return view('ProductViews.product-edit',compact('product','categories','brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate(Product::$rules);

        $product->update($validatedData);

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully');
    }

    public function enable(Product $product){
        $product->update(['enable' => true]);

        return redirect()-> route('products.index')
            ->with('success', 'Product enabled successfully');
    }
    public function disable(Product $product){
        $product->update(['enable' => false]);

        return redirect()->route('products.index')
            ->with('success', 'Product disabled successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
