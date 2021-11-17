@extends('layouts.app')
@section('content')
@include('categorylink')
<div class="flex">
  <div class="w-3/4 p-1 lg:p-5 xl:p-5 2xl:p-10">
    <div class="flex">
        <img src="/storage/products/{{$product->cover}}" class="w-96 h-96">
        <div class="px-5">
          <div>
            <h1 class="text-4xl text-center mb-2 text-gray-700">overview</h1>
            <p class="text-2xl">{{$product->name}}</p>
            <p class="text-3xl">
              <span class="text-first">★</span>
              <span class="text-first">★</span>
              <span class="text-first">★</span>
              <span class="text-first">★</span>
              <span class="text-gray-400">★</span>
              <span class="text-gray-700 text-xl my-auto">(2 reviews)</span>
             </p>
            <p class="text-lg my-2"> {{$product->description}}</p>
          </div>
          <div>
            <p class="text-2xl text-gray-700">unit price ${{$product->price}}</p>
          </div>
          <div>

          </div>
          <div>
            <comment-component @auth user-id="{{Auth::user()->id}}" @endauth product-id="{{$product->id}}"/>    
          </div>
        </div>
    </div>
   </div>
    <div class="m-2">
      <h1 class="text-2xl pb-2 border-b-2 border-gray-400">Recommended for you</h1>
        @foreach ($recommendedProducts as $product)
          <div class="flex w-max my-2">
            <a href="{{route('product.show',$product->id)}}">
              <img src="/storage/products/{{$product->cover}}" class="w-40">
              <div class="flex mx-1">
                <button class="mx-1.5">
                  <svg xmlns="http://www.w3.org/2000/svg" class="text-first h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                  </svg>
                </button>
                <button class="mx-1.5">
                  <svg xmlns="http://www.w3.org/2000/svg" class="text-first h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                  </svg>
                </button>
                <button class="mx-1.5">
                  <svg xmlns="http://www.w3.org/2000/svg" class="text-first h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                   </svg>
                </button>
                 <button class="mx-1.5">
                  <svg xmlns="http://www.w3.org/2000/svg" class="text-first h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                  </svg>
                 </button>
              </div>
            </a>
              <div class="mx-2">
                <p class="text-lg">{{$product->name}}</p>
                <p class="text-lg">unit price ${{$product->price}}</p>  
              </div>   
          </div>
        @endforeach  
    </div>
</div>
@endsection