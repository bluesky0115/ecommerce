@extends('layouts.app')
@section('main')
    <div>
        {{$product->name}}
        <img src="'products'.{{$product->id}}" alt="">
        {{$product->price}}
    </div>
    <div>
       <p> {{$product->description}}</p>
    </div>
@endsection