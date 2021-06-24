@extends('layouts.app')
@section('content')
@include('categorylink')
<div class="flex p-5">
  @forelse ($products as $product)
   <a href="{{route('product.show',$product->id)}}">
   <div class="m-2">
    <img src="/storage/products/{{$product->cover}}" class="w-48">
    <p class="text-xl">{{$product->name}}</p>
    <p class="text-xl">{{$product->price}} birr</p>
    <p>{{$product->description}}</p>
   </div>
   </a>   
  @empty
   <p>no products are found in {{$category->name}}</p>   
  @endforelse  
</div>   
@endsection