@extends('layouts.app')
@extends('content')
<div>
 @forelse ($orders as $order)
  <div>
   <div>
    <h1>order by</h1>
    <p>name: {{$order->user->name}}</p>
    <p>addres: {{$order->user->street}},{{order->user->city}}</p>   
   </div>
    @foreach ($order->products as $product)
    <div class="flex">
      <img src="" alt="">
      <div>
         <p>{{$product->name}}</p>
         <p>quantity {{$quantity}}</p>
         <p>amount {{$product->amount}}</p> 
      </div>    
    </div>   
    @endforeach
    <div>
     <p>total amount {{$totalAmount}}</p> 
     <complete-order order-id="{{order->id}}"/>   
   </div>     
  </div>   
 @empty
  <p>no orders yet</p>   
 @endforelse
</div>