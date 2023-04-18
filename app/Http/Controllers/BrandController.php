<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Http\Resources\BrandResource;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::all();

        return BrandResource::collection($brands);
    }

    public function show($id)
    {
        $brand = Brand::findOrFail($id);
        return new BrandResource($brand);
    }

    public function store(Request $request)
    {
        //
    }

    public function update(Request $request, Brand $brand)
    {
        //
    }

    public function destroy(Brand $brand)
    {
        //
    }
}
