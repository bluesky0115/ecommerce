@extends('layouts.app')
@section('content')
 <div>
   <form methos="post" action="{{route('product.store')}}">
     <p>add product here</p>
     <input type="text" name="name" placeholder="product name">
     <input type="decimal" placeholder="product cost">
     <input type="file">
  </form>    
 </div>   
@endsection