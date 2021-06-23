@extends('layouts.app')
@section('content')
<div class="container">
  <p class="text-xl text-white bg-green-50">{{session('message')}}</p>
  <header><categorylink-component/></header>
  <main><products-component user-id="{{Auth::user()->id}}"/></main>
</div>
@endsection
