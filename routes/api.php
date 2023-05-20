<?php

use App\Http\Controllers\APIControllers\APIBrandController;
use App\Http\Controllers\APIControllers\APICategoryController;
use App\Http\Controllers\APIControllers\APIClientController;
use App\Http\Controllers\APIControllers\APIOrderDetailController;
use App\Http\Controllers\APIControllers\APIProductController;
use App\Http\Controllers\APIControllers\APIShoppingCartController;
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
Route::middleware(['api'])->group(function () {

    Route::prefix('brands')->group(function () {
        Route::get('/', [APIBrandController::class, 'index']);
        Route::get('/{id}', [APIBrandController::class, 'show']);
    });

    Route::prefix('categories')->group(function () {
        Route::get('/', [APICategoryController::class, 'index']);
        Route::get('/{id}', [APICategoryController::class, 'show']);
    });

    Route::prefix('products')->group(function () {
        Route::get('/', [APIProductController::class, 'index']);
        Route::get('/{id}', [APIProductController::class, 'show']);
    });

    Route::prefix('order-details')->group(function () {
        Route::get('/', [APIOrderDetailController::class, 'index']);
        Route::get('/{id}', [APIOrderDetailController::class, 'show']);
        Route::get('/create', [APIOrderDetailController::class, 'create']);
    });

    Route::prefix('shopping-carts')->group(function () {
        Route::get('/', [APIShoppingCartController::class, 'index'])->name('index');
        Route::get('/{id}', [APIShoppingCartController::class, 'show'])->name('show');
        Route::get('/create', [APIShoppingCartController::class, 'create']);
        Route::post('/', [APIShoppingCartController::class, 'store'])->name('store');
    });

    Route::prefix('clients')->group(function ()  {
        Route::get('/', [APIClientController::class, 'index']);
        Route::get('/{id}', [APIClientController::class, 'show']);
        Route::get('/create', [APIClientController::class, 'create']);
        Route::post('/', [APIClientController::class, 'store']);
    });
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
