<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
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
    Route::delete('delete/{product}',[ProductController::class,'destroy'])->name('product.delete');
    Route::get('search',[ProductController::class,'search'])->name('product.search');
    Route::get('data',[ProductController::class,'data']);
    Route::post('addtocart',[ProductController::class,'addToCart']);
    Route::post('removefromcart',[ProductController::class,'removeFromCart']);
});

Route::prefix('profile')->group(function(){
  Route::get('create',[ProfileController::class,'create'])->name('profile.create');
  Route::get('edit',[ProfileController::class,'eidt'])->name('profile.edit');
  Route::post('update',[ProfileController::class,'update'])->name('profile.update');
});
Route::get('products',[ProductController::class,'index']);

Route::get('orders',[OrderController::class,'index'])->name('orders');
Route::get('order',[OrderController::class,'orderForm'])->name('order');
Route::post('order',[OrderController::class,'order']);
Route::post('order/complete',[OrderController::class,'destroy'])->name('order.complete');

Route::get('cartitems',[CartController::class,'cartItems']);
Route::post('cartitems/add',[CartController::class,'cartItems']);
Route::get('/cart/product',[CartController::class,'productInCart']);

Route::get('notifications',[UserController::class,'notifications']);
Route::post('notification/category',[UserController::class,'notificationForm']);
Route::post('notification/unread',[UserController::class,'unreadNotification']);

Route::post('report',[UserController::class,'report']);
Route::post('report/remove',[UserController::class,'removeReport'])->name('report.remove');
Route::get('reports',[AdminController::class,'reports']);

Route::get('categories',[CategoryController::class,'index']);
Route::get('isAdmin',[UserController::class,'isAdmin']);
Route::view('about','about')->name('about');

Route::get('comments',[CommentController::class,'index']);
Route::post('commnet/store',[CommentController::class,'store']);
Route::post('commnet/update',[CommentController::class,'update']);
Route::post('commnet/delete',[CommentController::class,'delete']);