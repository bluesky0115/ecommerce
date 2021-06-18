@extends('layouts.app')
@section('content')
  <div>
  @forelse ($products as $product)
   <div>
   <img src="/products/{{$product->id}}" alt="">
   <p>{{$product->name}}</p>
   <p>price {{$product->price}}</p>
   <a href="{{route('product.show',$product->id)}}">details</a>    
   </div>   
  @empty
   <p class="text-2xl text-center">there is no {{$categoryName}} like {{$searchQuery}}</p>   
  @endforelse    
  </div>  
@endsection