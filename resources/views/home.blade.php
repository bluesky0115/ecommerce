@extends('layouts.app')
@section('content')
<div class="container">
<div>
  <ul>
    <li><a href="{{route('/')}}">all</a></li>
    @foreach ($categories as $category)
      <li><a href="{{route('/')}}">{{$category->name}}</a></li>    
    @endforeach
    </ul>
</div>
    <div class="flex">
      @forelse ($category->products as $product)
          <div class="flex-auto w-max">
              <img src="/products{{$product->cover}}" alt="" width="100px">
              <p class="text-xl text-center">{{$product->name}}</p>
              <p class="text-xl text-center">{{$product->price}} birr</p>
              <p>
              <a href="{{route('product.show',$product)}}">buy</a>
              <addtocart-component product-id="{{$product->id}}" user-id="{{$user->id}}"/>
              <a href="{{route('product.details',$product->id)}}">details</a>
              <report-component product-id="{{$product->id}}">
              </p>
          </div>
      @empty
          <p class="text-xl text-red-700 bg-red-100 w-max">oops no products were found</p>
      @endforelse
    </div>
</div>
@endsection
