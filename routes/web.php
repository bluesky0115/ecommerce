<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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
    Route::get('edit/{product}',[ProductController::class,'edit'])->name('product.edit');
    Route::patch('update',[ProductController::class,'update'])->name('product.update');
    Route::get('show/{product}',[ProductController::class,'show'])->name('product.show');
    Route::delete('delete/{product}',[ProductController::class,'delete'])->name('product.delete');
    Route::get('search',[ProductController::class,'search'])->name('product.search');
    Route::post('addtocart',[ProductController::class,'postAddToCart'])->name('product.getAddToCart');
    Route::post('addtocart',[ProductController::class,'postAddToCart'])->name('product.postAddToCart');
});

Route::get('notifications',[UserController::class,'notifications']);
Route::post('notification/category',[UserController::class,'notificationForm']);
Route::post('report',[UserController::class,'report']);
Route::post('report/remove',[UserController::class,'removeReport'])->name('report.remove');
Route::get('reports',[AdminController::class,'reports']);
Route::post('notification/unread',[UserController::class,'unreadNotification']);