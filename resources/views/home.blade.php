@extends('layouts.app')

@section('content')
<div class="container">
    <ul>
    <li>All</li>
    @foreach ($categories as $category)
      <li>{{$category->title}}</li>    
    @endforeach
    </ul>
    <div>
      @forelse ($category->products as $product)
          <div>
              <img src="'products'.{{$product->id}}" alt="">
              {{$product->name}}
              {{$product->price}}
              <a href="{{route('product.buy',$productId)}}">buy</a>
              <a href="{{route('products.addToCart',$productId)}}">add to cart</a>
              <a href="{{route('product.details',$productId)}}">detail</a>
          </div>
      @empty
          <p>oops no products were found</p>
      @endforelse
    </div>
</div>
@endsection
