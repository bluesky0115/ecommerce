@extends('layouts.app')
@section('content')
  <div>
   @forelse ($products as $product)
       
   @empty
   <p>no products saved yet</p>    
   @endforelse
  </div>  
@endsection