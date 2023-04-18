<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'orders_detail';

    protected $fillable = [
        'product_amount',
        'shopping_cart_id',
        'product_id',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function shoppingCart()
    {
        return $this->belongsTo(ShoppingCart::class);
    }
}
