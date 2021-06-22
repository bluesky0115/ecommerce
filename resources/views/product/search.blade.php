@extends('layouts.app')
@section('content')
  <div class="flex">
  @forelse ($products as $product)
  <a href="{{route('product.show',$product->id)}}">
   <div>
   <img src="/storage/products/{{$product->cover}}" class="w-48">
   <p>{{$product->name}}</p>
   <p>price {{$product->price}}</p> 
   <div>
    <addtocart-component user-id="{{Auth::user()->id}}" product-id="{{$product->id}}">  
   </div>   
   </div> 
  </a>  
  @empty
   <p class="text-2xl m-10">oops there is no {{$categoryName}} found like {{$searchQuery}}</p>   
  @endforelse    
  </div>  
@endsection