@extends('layouts.app')
@section('content')
<div class="p-5">
  <p class="text-xl bg-green-50 text-center">{{session('message')}}</p>
  @include('categorylink')
  <div class="block md:flex lg:flex xl:flex 2xl:flex">
    @forelse ($products as $product)
    <div class="m-2">
     <a href="{{route('product.show',$product->id)}}">
       <img src="/storage/products/{{$product->cover}}" class="w-60">
       <p>{{$product->name}}</p>
       <p>{{$product->price}} birr</p>
     </a>
    <div class="flex">
      @auth 
       <addtocart-component product-id="{{$product->id}}" user-id="{{Auth::user()->id}}"/>  
      @endauth
      <seeproduct-component />
      <addtolike-component />
      <>
    </div> 
   </div>   
  @empty
   <p class="text-3xl my-3 mx-10">no products are found</p>   
  @endforelse
  </div>
</div>
@endsection