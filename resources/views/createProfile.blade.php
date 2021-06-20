@extends('layouts.app')
@section('content')
  <div>
   <form method="POST" action="{{route('profile.create')}}">
     {{ csrf_field() }}
     <p class="">phone number</p>
     <input type="text" name="phone_number" required class="" >
     <p class="">city</p>
     <input type="text" name="city" required class="">
     <p class="">street</p>
     <input type="text" name="street" required class="">
     <input type="submit" value="create profile" class="">
  </form>   
  </div> 
@endsection