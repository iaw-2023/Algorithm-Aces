<?php

namespace App\Http\Controllers\APIControllers;

use App\Http\Resources\OrderDetailResource;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class APIOrderDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $order_details = OrderDetail::all();
        return OrderDetailResource::collection($order_details);
    }

/**
 * Show the form for creating a new order detail in JSON format.
 * Product amount must be at least 1
 * Shopping Cart ID must be of a shopping cart already in the database
 * Product ID must be of a product already in the database 
 */
public function create()
{
    $orderDetailFields = [
        'product_amount' => [
            'type' => 'number',
            'label' => 'Product Amount',
            'required' => true
        ],
        'shopping_cart_id' => [
            'type' => 'number',
            'label' => 'Shopping Cart ID',
            'required' => true
        ],
        'product_id' => [
            'type' => 'number',
            'label' => 'Product ID',
            'required' => true
        ],
    ];

    return response()->json([
        'fields' => $orderDetailFields,
    ]);
}



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order_detail = OrderDetail::findOrFail($id);
        return new OrderDetailResource($order_detail);
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
