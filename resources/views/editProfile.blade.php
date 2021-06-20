@extends('layouts.app')
@section('content')
  <div>
   <form method="POST" action="{{route('profile.update')}}">
     {{ csrf_field() }}
     <p class="">phone number</p>
     <input type="text" name="phone_number" class="">
     <p class="">city</p>
     <input type="text" name="city" class="">
     <p class="">street</p>
     <input type="text" name="street" class="">
     <input type="submit" value="create profile" class="">
  </form>   
  </div> 
@endsection