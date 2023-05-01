<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        'name','enable'
    ];

    public static $rules = [
        'name' => 'required|regex:/^[a-zA-Z0-9\s]{1,20}$/|unique:brands',
        'enable' => 'required|boolean',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
