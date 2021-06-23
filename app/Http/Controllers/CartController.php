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
    public function cartItems(Request $request)
    {
      $user=User::find($request->userId);
      $cartItems=$user->cart->products;
      return response()->json(['cartItems'=>$cartItems]);
    }
    public function addToCart(Request $request)
    {
      $user=User::find($request->userId);
      $product=Product::find($request->productId);
      if($user->cart){
        $user->cart->syncWithoutDetaching($product);
      }
      else{
        $cart=new Cart;
        $cart->user=$user;
        $user->cart->syncWithoutDetaching($product);
      }  
    }
    public function productInCart(Request $request)
    {
      $user=User::find($request->userId);
      $product=Product::find($request->productId);
      $cart=$user->cart;
      if(in_array($product,json_decode($cart->products))){
        $productInCart=true;
      }
      else{
        $productInCart=false;
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
