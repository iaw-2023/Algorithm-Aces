<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShoppingCartController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::get('/users', 'UserController@index');
Route::post('/users', 'UserController@store');
Route::put('/users/{id}', 'UserController@update');
Route::delete('/users/{id}', 'UserController@destroy');

Route::prefix('api')->group(function () {
    Route::prefix('brands')->group(function () {
        Route::get('/', [BrandController::class, 'index']);
        Route::get('/{id}', [BrandController::class, 'show']);
    });

    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index']);
        Route::get('/{id}', [CategoryController::class, 'show']);
    });

    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index']);
        Route::get('/{id}', [ProductController::class, 'show']);
    });

    Route::prefix('order-detail')->group(function () {
        Route::get('/', [OrderDetailController::class, 'index']);
        Route::get('/{id}', [OrderDetailController::class, 'show']);
        Route::post('/', [OrderDetailController::class, 'store']);
        Route::put('/{id}', [OrderDetailController::class, 'update']);
        Route::delete('/{id}', [OrderDetailController::class, 'destroy']);
    });

    Route::prefix('shopping-cart')->group(function () {
        Route::get('/', [ShoppingCartController::class, 'index'])->name('index');
        Route::get('/{id}', [ShoppingCartController::class, 'show'])->name('show');
        Route::post('/', [ShoppingCartController::class, 'store'])->name('store');
        Route::put('/{id}', [ShoppingCartController::class, 'update'])->name('update');
        Route::delete('/{id}', [ShoppingCartController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('clients')->group(function ()  {
        Route::get('/', [ClientController::class, 'index']);
        Route::get('/{id}', [ClientController::class, 'show']);
        Route::post('/', [ClientController::class, 'store']);
        Route::put('/{id}', [ClientController::class, 'update']);
        Route::delete('/{id}', [ClientController::class, 'destroy']);
    });

});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

