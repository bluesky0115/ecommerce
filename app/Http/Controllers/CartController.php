<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){

      $this->middleware('auth');
      
    }

    public function cartItems(Request $request)
    {
      $user=User::find($request->userId);
      $cartId=$user->cart->id;
      $cart=Cart::find($cartId);
      $cartItems=$cart->products;
      return response()->json(['cartItems'=>$cartItems]);
    }
    public function addToCart(Request $request)
    {
      $user=User::find($request->userId);
      $product=Product::find($request->productId);
      $user->cart->products()->attach($product);
    }

    public function removeFromCart(Request $request)
    {
      $user=User::find($request->userId);
      $product=Product::find($request->productId);
      $cart=Cart::find($user->cart->id);
      $cart->products()->detach($product);
    }

    public function productInCart(Request $request)
    {
      $user=User::find($request->userId);
      $item=Product::find($request->productId);
      $cart=$user->cart;
      $products=$cart->products;
      $productInCart=false;
      foreach ($products as $product) {
        if($product->id==$item->id){
          $productInCart=true;
        }
      }
      return response()->json(['productInCart'=>$productInCart]);  
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
