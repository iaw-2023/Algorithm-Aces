<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        'name',
    ];

    public static $rules = [
        'name' => 'required|unique:brands,name|min:1|max:20'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
