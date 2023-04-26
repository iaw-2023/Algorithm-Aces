<?php

namespace App\Http\Controllers\APIControllers;

use App\Models\Brand;
use App\Http\Resources\BrandResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
