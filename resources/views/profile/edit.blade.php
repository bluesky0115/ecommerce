@extends('layouts.app')
@section('content')
 <div class="z-20 bg-white rounded-xl p-10 w-1/2 my-10 mx-auto">
  <p class="text-2xl text-center mb-5">Edit your profile</p>
 <form method="POST" action="{{route('profile.store')}}">
    @csrf
    <p class="text-xl">phone number</p>
    <input type="text" name="phone_number" value="{{$user->profile->phone_number}}" required class="mx-auto w-3/4 h-10 rounded p-2 m-2 border-2 border-gray-600 focus:border-blue-500" >
    <p class="text-xl">city</p>
    <input type="text" name="city" required value="{{$user->profile->city}}" class="mx-auto w-3/4 h-10 rounded p-2 m-2 border-2 border-gray-600 focus:border-blue-500">
    <p class="text-xl">street</p>
    <input type="text" name="street" required value="{{$user->profile->street}}" class="mx-auto w-3/4 h-10 rounded p-2 m-2 border-2 border-gray-600 focus:border-blue-500">
  <div class="mx-10">
    <p class="text-xl">edit the categories you are interested to be notified</p>
    @isset($categories)
      @foreach ($categories as $category)
       <p class="text-lg"><input type="checkbox" name="categories[]" value="{{$category->id}}">{{$category->name}}</p>
      @endforeach
    @endisset
  <input type="submit" value="complete profile" class="bg-green-600 text-xl px-5 py-1 m-4 rounded text-white">
  </div>
 </form>    
 </div>
 <div class="z-10 -inset-full bg-black opacity-50"></div>   
@endsection