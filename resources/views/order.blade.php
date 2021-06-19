@extends('layouts.app')
@section('content')
  <div>
  <h1>your orders</h1>
  <order-component user-id="{{Auth::user()->id}}"/>   
  </div>  
@endsection