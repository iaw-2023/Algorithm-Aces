<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        'name','enable'
    ];

    public static $rules = [
        'name' => 'required|regex:/^[a-zA-ZáéíóúÁÉÍÓÚàèìòùÀÈÌÒÙäëïöüÄËÏÖÜâêîôûÂÊÎÔÛñÑ0-9\s ]{1,20}$/|unique:brands',
        'enable' => 'boolean',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
