@extends('layouts.app')
@section('main')
    <div>
        <p class="text-xl">{{$product->name}}</p>
        <img src="products/{{$product->photo}}" alt="" width="200px">
        <p>price {{$product->price}} birr</p>
        <p> {{$product->description}}</p>
    </div>
    <div>
       @can('update', Product::class)
       <form method="POST" action="{{route('product.update',$product->id)}}">
        {{csrf_field}}
        @method('update')
        <input type="submit" value="delete">
       </form> 
       @endcan
       @can('delete', Product::class)
       <form method="POST" action="{{route('product.delete',$product->id)}}">
        {{csrf_field}}
        @method('delete')
        <input type="submit" value="delete">
       </form> 
       @endcan 
    </div>
    <div>
        <div class="flex">
            @foreach ($similaProducts as $product)
                <div class="flex-auto w-max">
                    <img src="/products{{$product->cover}}" alt="" width="100px">
                    <p class="text-xl text-center">{{$product->name}}</p>
                    <p class="text-xl text-center">{{$product->price}} birr</p>
                    <div>
                      <span><a href="{{route('product.buy',$productId)}}">buy</a></span>
                      <span>
                        <addtocart-component product-id="{{$product->id}}" user-id="{{$user->id}}"/>
                      </span>
                      <span><a href="{{route('product.details',$productId)}}">details</a></span>
                    </div>
                </div>
            @endforeach  
       </div>
@endsection