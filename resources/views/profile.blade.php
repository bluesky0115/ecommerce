@extends('layouts.app')
@section('content')
 <div>
 <form action="{{route('profile.update')}}">
    <p class="">phone number</p>
    <input type="text" name="phone_number" required class="" >
    <p class="">city</p>
    <input type="text" name="city" required class="">
    <p class="">street</p>
    <input type="text" name="street" required class="">
  <p>this website wants to notify you <br> in which product are you interested</p>
  @foreach ($categories as $category)
    <p><input type="checkbox" name="categories[]" value="{{$category->id}}">{{category->name}}</p>
  @endforeach
  <input type="submit" value="complete profile" class="bg-primary text-white">
 </form>    
 </div>   
@endsection