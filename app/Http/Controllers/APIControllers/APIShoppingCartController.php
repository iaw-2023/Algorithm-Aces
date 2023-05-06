<?php

namespace App\Http\Controllers\APIControllers;

use App\Http\Resources\ShoppingCartResource;
use App\Models\ShoppingCart;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class APIShoppingCartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shopping_carts = ShoppingCart::all();
        return ShoppingCartResource::collection($shopping_carts);
    }

    /**
     * Show the form for creating a new shopping cart in JSON format.
     * Order Details array must have at least one element
     * The Client ID must be of a client already in the database
     * Total price must be at least 0 included
     */
    public function create()
    {
        $shoppingCartFields = [
            'total_price' => [
                'type' => 'number',
                'label' => 'Total Price',
                'required' => true
            ],
            'date' => [
                'type' => 'date',
                'label' => 'Date',
                'required' => true
            ],
            'client_id' => [
                'type' => 'number',
                'label' => 'Client ID',
                'required' => true
            ],
            'order_details' => [
                'type' => 'array',
                'label' => 'Order Details',
                'required' => true
            ],
        ];

        return response()->json([
            'fields' => $shoppingCartFields,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     * Validates the stock consistency for each product sold 
     */
    public function store(Request $request)
    {
        try {
            
            DB::beginTransaction();
            
            $validatedData = $request->validate(ShoppingCart::$rules);
            $shoppingCartData = [
                'total_price' => $validatedData['total_price'],
                'date' => $validatedData['date'],
                'client_id' => $validatedData['client_id'],
            ];
            $shoppingCart = ShoppingCart::create($shoppingCartData);
            
            $orderDetailsData = $validatedData['order_details'];
            foreach ($orderDetailsData as $orderDetailData) {
                $orderDetailValidatedData = Validator::make($orderDetailData, OrderDetail::$rules)->validated();
                
                //Check valid stock for the product
                if (!$this->validateProductAmount($orderDetailValidatedData)) {
                    throw new \Exception("Product amount is greater than product stock.");
                }

                //Update the new stock for the product
                $this->updateStock($orderDetailValidatedData);

                $orderDetail = new OrderDetail($orderDetailValidatedData);
                $shoppingCart->ordersDetail()->save($orderDetail);
            }
    
            DB::commit();
            return new ShoppingCartResource($shoppingCart);
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
    /**
     * Validates that the product sell is valid
     */
    private function validateProductAmount($orderDetailData){
        $isValid = true;
        $productAmount = $orderDetailData['product_amount'];
        $productStock = Product::findOrFail($orderDetailData['product_id'])->stock;

        return $productStock - $productAmount >= 0;
    }

    /**
     * Deducts the amount of product sold from the stock
     */
    private function updateStock($orderDetailData){
        $product = Product::findOrFail($orderDetailData['product_id']);
        $product->stock -= $orderDetailData['product_amount'];
        $product->save();
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
