@extends('layouts.app')
@section('content')
@include('categorylink')
<div class="flex">
  <div class="w-3/4 p-1 lg:p-5 xl:p-5 2xl:p-10">
    <div class="flex">
        <img src="/storage/products/{{$product->cover}}" class="w-96">
        <div class="p-2">
          <h1 class="text-3xl text-center">overview</h1>
          <p class="text-2xl mx-10">{{$product->name}}</p>
          <p>unit price ${{$product->price}}</p>
          <p class="text-lg mx-10"> {{$product->description}}</p>
        </div>
    </div>
     <comment-component @auth user-id="{{Auth::user()->id}}" @endauth product-id="{{$product->id}}"/>    
   </div>
    <div class="m-2">
      <h1 class="text-2xl">Recommended for you</h1>
        @foreach ($recommendedProducts as $product)
          <div class="flex w-max my-2">
            <a href="{{route('product.show',$product->id)}}">
              <img src="/storage/products/{{$product->cover}}" class="w-40">
            </a>
              <div class="mx-2">
                <p class="text-xl text-center">{{$product->name}}</p>
                <p class="text-xl text-center">{{$product->price}} birr</p>  
                @auth
                <addtocart-component product-id="{{$product->id}}" user-id="{{Auth::user()->id}}"/>  
                @endauth
              </div>   
          </div>
        @endforeach  
    </div>
</div>
@endsection