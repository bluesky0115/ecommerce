<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){

      $this->middleware('auth');

    }

    public function index()
    {
     $orders=Order::latest()->get();
     return view('orders',['orders'=>$orders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('order',);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $user=User::find($request->userId);
      $orderItems=$request->orderItems;
      $order=new Order;
      foreach($orderItems as $orderItem){
        $product=Product::find($orderItem->id);
        $product->quantity=$orderItem->quantity;
        $order->products()->attach([$product->id=>[
          'quantity'=>$product->quantity
        ]]);
      }
      $order->user_id=$user->id;
      $order->save();
      $order->users()->attach($user->id);
      return redirect()->back()->with(['message'=>'order successfull']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(request $request)
    {
      $order=Order::find($request->orderId);
      $order->delete();
      return response()->json(['successMessage'=>'order completed successfully']);
    }
}
