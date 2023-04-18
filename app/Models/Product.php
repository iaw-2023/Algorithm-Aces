<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'size', 'image', 'price', 'brand_id', 'category_id'
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function ordersDetail()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
