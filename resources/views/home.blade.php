@extends('layouts.app')
@section('content')
<div class="container">
  <header><categorylink-component/></header>
  <main><products-component user-id="{{Auth::user()->id}}"/></main>
</div>
@endsection
