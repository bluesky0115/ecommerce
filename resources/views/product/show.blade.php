@extends('layouts.app')
@section('main')
    <div>
        <p class="text-xl">{{$product->name}}</p>
        <img src="products/{{$product->photo}}" alt="" width="200px">
        <p>price {{$product->price}} birr</p>
        <p> {{$product->description}}</p>
    </div>
@endsection