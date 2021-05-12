@extends('layouts.app')
@section('main')
    <div>
        <p class="text-xl">{{$product->name}}</p>
        <img src="products/{{$product->photo}}" alt="" width="200px">
        <p>price {{$product->price}} birr</p>
        <p> {{$product->description}}</p>
    </div>
    <div>
       @can('delete', Product::class)
       <form method="POST" action="{{route('product.delete',$product->id)}}">
        {{csrf_field}}
        @delete
        <input type="submit" value="delete">
       </form> 
       @endcan 
    </div>
@endsection