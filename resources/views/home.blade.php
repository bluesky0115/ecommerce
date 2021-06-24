@extends('layouts.app')
@section('content')
<div class="">
  <p class="text-xl bg-green-50 text-center">{{session('message')}}</p>
  <header><categorylink-component/></header>
  {{-- <main><products-component user-id="{{Auth::user()->id}}"/></main> --}}
</div>
@endsection
