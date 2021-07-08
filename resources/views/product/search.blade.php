@extends('layouts.app')
@section('content')
  <div class="p-5">
  <p class="text-2xl font-semibold mx-10 mb-3">{{$products->count()}} products found</p>
  @forelse ($products as $product)
   <div class="flex justify-between w-full lg:1/2 xl:w-1/2 2xl:w-1/2 p-3 rounded-md bg-white hover:bg-gray-300 m-2">
    <a href="{{route('product.show',$product->id)}}">
    <div class="flex">
      <img src="/storage/products/{{$product->cover}}" class="w-48">
      <div class="mx-3 my-auto">
        <p class="text-xl">{{$product->name}}</p>
        <p class="text-xl">{{$product->price}} birr</p> 
        <p>{{$product->description}}</p>
        @auth
        <div>
         <addtocart-component user-id="{{Auth::user()->id}}" product-id="{{$product->id}}">  
        </div>  
      </div>   
      @endauth  
    </div>
   </a>     
    <div>
     <p>buy</p>
     <p>report</p>
     <p>edit</p>
     <p>delete</p>
    </div>
   </div> 
  @empty
   <p class="text-2xl m-10">oops there is no {{$categoryName}} found like {{$searchQuery}}</p>   
  @endforelse    
  </div>  
@endsection