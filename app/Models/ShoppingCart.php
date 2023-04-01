<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    protected $table = 'shopping_carts';

    protected $fillable = [
        'total_price',
        'date',
        'client_id',
    ];

    protected $dates = [
        'date',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function orderDetail()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
