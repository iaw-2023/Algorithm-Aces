<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{


    protected $fillable = ['email'];

    public function orders()
    {
        return $this->hasMany(ShoppingCart::class);
    }
}
