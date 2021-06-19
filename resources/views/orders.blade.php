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
   <div>
      
   </div>   
  </div>   
 @empty
  <p>no orders yet</p>   
 @endforelse
</div>