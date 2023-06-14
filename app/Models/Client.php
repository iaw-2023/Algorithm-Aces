<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Client extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;
    protected $guard = 'client';

    protected $fillable = [
        'email', 
        'password'
    ];

    protected $hidden = [
        'password', 'remember_token',
      ];

    public static $rules = [
        'email' => 'required|email|unique:clients,email',
        'password' => 'required|string',
    ];

    public function shoppingCarts()
    {
        return $this->hasMany(ShoppingCart::class);
    }

    public function getJWTIdentifier() {
        return $this->getKey();
    }

    public function getJWTCustomClaims() {
        return [];
    }  
}
