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
}
