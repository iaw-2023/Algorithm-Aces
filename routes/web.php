<?php

use App\Http\Controllers\ViewControllers\BrandController;
use App\Http\Controllers\ViewControllers\CategoryController;
use App\Http\Controllers\ViewControllers\ClientController;
use App\Http\Controllers\ViewControllers\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Auth::routes();



//CategoryView route
Route::middleware(['auth'])->group(function () {

    Route::get('/', [ProductController::class, 'index'])->name('home');
    Route::get('/home', [ProductController::class, 'index'])->name('home');

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [App\Http\Controllers\ViewControllers\CategoryController::class, 'create'])->name('categories.create');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::post('/categories', [App\Http\Controllers\ViewControllers\CategoryController::class, 'store'])->name('categories.store');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    Route::put('/categories/{category}/disable', [CategoryController::class, 'disable'])->name('categories.disable');
    Route::put('/categories/{category}/enable', [CategoryController::class, 'enable'])->name('categories.enable');

    Route::get('/brands', [BrandController::class, 'index'])->name('brands.index');
    Route::get('/brands/create', [App\Http\Controllers\ViewControllers\BrandController::class, 'create'])->name('brands.create');
    Route::get('/brands/{brand}/edit', [BrandController::class, 'edit'])->name('brands.edit');
    Route::post('/brands', [App\Http\Controllers\ViewControllers\BrandController::class, 'store'])->name('brands.store');
    Route::put('/brands/{brand}', [BrandController::class, 'update'])->name('brands.update');
    Route::delete('/brands/{brand}', [BrandController::class, 'destroy'])->name('brands.destroy');
    Route::put('/brands/{brand}/disable', [BrandController::class, 'disable'])->name('brands.disable');
    Route::put('/brands/{brand}/enable',  [BrandController::class, 'enable'])->name('brands.enable');

    Route::get('/clients',[ClientController::class,'index'])->name('clients.index');

    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::put('/products/{product}/disable', [ProductController::class, 'disable'])->name('products.disable');
    Route::put('/products/{product}/enable', [ProductController::class, 'enable'])->name('products.enable');
    Route::put('/products/{product}/edit-stock', [ProductController::class, 'editStock'])->name('products.edit-stock');




});

