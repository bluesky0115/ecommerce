@extends('layouts.app')
@section('content')
 <div>
   <form methos="post" action="{{route('product.store')}}">
     <p>add product here</p>
     <input type="text" name="name" placeholder="product name">
     <input type="decimal" placeholder="product cost">
     <input type="file" name="photo">
     <textarea name="description" id="" cols="30" rows="10"></textarea>
     <input type="submit" value="sell product">
  </form>    
 </div>   
@endsection