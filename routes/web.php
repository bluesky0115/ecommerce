<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::prefix('product')->group(function () {
    Route::get('create',[ProductController::class,'create'])->name('product.create');
    Route::post('create',[ProductController::class,'store'])->name('product.store');
    Route::get('edit/{id}',[ProductController::class,'edit'])->name('product.edit');
    Route::patch('update',[ProductController::class,'update'])->name('product.update');
    Route::get('show/{id}',[ProductController::class,'show'])->name('product.show');
    Route::delete('delete/{id}',[ProductController::class,'delete'])->name('product.delete');
    Route::post('addtocart',[ProductController::class,'postAddToCart'])->name('product.getAddToCart');
    Route::post('addtocart',[ProductController::class,'postAddToCart'])->name('product.postAddToCart');
});