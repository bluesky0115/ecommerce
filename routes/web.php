<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
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
  $products=Product::latest()->take(100)->get();
  return view('home',['products'=>$products]);
})->name('home');

Auth::routes();

Route::prefix('product')->group(function () {
    Route::get('create',[ProductController::class,'create'])->name('product.create');
    Route::post('create',[ProductController::class,'store'])->name('product.store');
    Route::get('edit/{product}',[ProductController::class,'edit'])->name('product.edit');
    Route::patch('update',[ProductController::class,'update'])->name('product.update');
    Route::get('show/{product}',[ProductController::class,'show'])->name('product.show');
    Route::delete('delete/{product}',[ProductController::class,'destroy'])->name('product.delete');
    Route::get('search',[ProductController::class,'search'])->name('product.search');
    Route::get('data',[ProductController::class,'data']);
    Route::get('savedproducts',[ProductController::class,'savedProducts']);
});

Route::prefix('profile')->group(function(){
  Route::get('create',[ProfileController::class,'create'])->name('profile.create');
  Route::post('store',[ProfileController::class,'store'])->name('profile.store');
  Route::get('edit',[ProfileController::class,'edit'])->name('profile.edit');
  Route::post('update',[ProfileController::class,'update'])->name('profile.update');
});

Route::get('products',[ProductController::class,'index']);
Route::get('/products/{id}',[CategoryController::class,'categoryProducts'])->name('product.specificproduct');

Route::get('orders',[OrderController::class,'index'])->name('orders');
Route::get('order',[OrderController::class,'create'])->name('order');
Route::post('order',[OrderController::class,'store']);
Route::post('order/complete',[OrderController::class,'destroy'])->name('order.complete');

Route::get('cartitems',[CartController::class,'cartItems']);
Route::get('cart/product',[CartController::class,'productInCart']);
Route::post('cart/addproduct',[CartController::class,'addToCart']);
Route::post('cart/removeproduct',[CartController::class,'removeFromCart']);

Route::get('notifications',[UserController::class,'notifications']);
Route::post('notification/category',[UserController::class,'notificationForm']);
Route::post('notification/read',[UserController::class,'readNotification']);

Route::post('report',[UserController::class,'report']);
Route::post('report/remove',[UserController::class,'removeReport'])->name('report.remove');
Route::get('reports',[AdminController::class,'reports']);
Route::get('/navigation',[UserController::class,'navigation']);
Route::get('categories',[CategoryController::class,'index']);
Route::get('category/product',[CategoryController::class,'categoryProducts']);

Route::view('about','about')->name('about');

Route::get('comments',[CommentController::class,'index']);
Route::post('comment/store',[CommentController::class,'store']);
Route::patch('comment/update',[CommentController::class,'update']);
Route::delete('comment/delete',[CommentController::class,'destroy']);
