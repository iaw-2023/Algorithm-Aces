<?php

namespace App\Http\Controllers\APIControllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\APIControllers\BaseAPIController;

class APIProductController extends BaseAPIController
{
/**
 * Display a listing of the resource.
 *
 * @OA\Get(
 *      path="/rest/products",
 *      tags={"Products"},
 *      summary="Display a listing of products",
 *      description="Get all products with their details",
 *      @OA\Response(
 *          response=200,
 *          description="Success",
 *          @OA\JsonContent(
 *              @OA\Property(
 *                  property="data",
 *                  type="array",
 *                  @OA\Items(ref="#/components/schemas/ProductResource")
 *              )
 *          )
 *      ),
 *      @OA\Response(
 *          response=401,
 *          description="Unauthenticated",
 *      ),
 *      @OA\Response(
 *          response=403,
 *          description="Unauthorized",
 *      ),
 * )
 */
    public function index()
    {
        $products = Product::all();
        return ProductResource::collection($products);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

/**
 * @OA\Get(
 *     path="/rest/products/{id}",
 *     summary="Show a single product",
 *     description="Display the specified product.",
 *     operationId="showProduct",
 *     tags={"Products"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID of the product to show",
 *         required=true,
 *         @OA\Schema(
 *             type="integer",
 *             example=1
 *         )
 *     ),
 *     @OA\Response(
 *         response="200",
 *         description="Successful operation",
 *         @OA\JsonContent(ref="#/components/schemas/ProductResource")
 *     ),
 *     @OA\Response(
 *         response="404",
 *         description="Product not found"
 *     )
 * )
 */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        return new ProductResource($product);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
