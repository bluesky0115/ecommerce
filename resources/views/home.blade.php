@extends('layouts.app')
@section('content')
<div class="p-5">
  <p class="text-xl bg-green-50 text-center">{{session('message')}}</p>
  @include('categorylink')
  <div class="block md:flex lg:flex xl:flex 2xl:flex">
    @forelse ($products as $product)
   <a href="{{route('product.show',$product->id)}}">
   <div class="m-2">
    <img src="/storage/products/{{$product->cover}}" class="w-60">
    <p>{{$product->name}}</p>
    <p>{{$product->price}} birr</p>
    <addtocart-component product-id="{{$product->id}}" @auth user-id="{{Auth::user()->id}}" @endauth />
   </div>
   </a>   
  @empty
   <p>no products are found</p>   
  @endforelse
  </div>
</div>
@endsection