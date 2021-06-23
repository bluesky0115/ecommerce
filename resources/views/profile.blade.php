@extends('layouts.app')
@section('content')
 <div class="bg-white rounded-xl p-10 w-1/2 my-10 mx-auto">
  <p class="text-2xl text-center mb-5">complete your profile</p>
 <form action="{{route('profile.update')}}">
    <p class="text-xl">phone number</p>
    <input type="text" name="phone_number" required class="mx-auto w-3/4 h-10 rounded p-2 m-2 border-2 border-gray-600 focus:border-blue-500" >
    <p class="text-xl">city</p>
    <input type="text" name="city" required class="mx-auto w-3/4 h-10 rounded p-2 m-2 border-2 border-gray-600 focus:border-blue-500">
    <p class="text-xl">street</p>
    <input type="text" name="street" required class="mx-auto w-3/4 h-10 rounded p-2 m-2 border-2 border-gray-600 focus:border-blue-500">
  <div class="mx-10">
    <p class="text-xl">this website wants to notify you <br> in which product are you interested</p>
  @foreach ($categories as $category)
    <p class="text-lg"><input type="checkbox" name="categories[]" value="{{$category->id}}">{{$category->name}}</p>
  @endforeach
  <input type="submit" value="complete profile" class="bg-blue-500 text-xl px-2 py-1 m-1 rounded text-white">
  </div>
 </form>    
 </div>   
@endsection