@extends('layouts.app')
@section('content')
  <div>
  <order-component user-id="{{Auth::user()->id}}"/>   
  </div>  
@endsection