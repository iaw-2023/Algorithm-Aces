<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Category extends Model
{


    protected $fillable = ['name'];
    public static $rules = [
        'name' => 'required|unique:categories,name|min:1|max:20'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}

