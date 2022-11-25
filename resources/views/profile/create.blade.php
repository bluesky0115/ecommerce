@extends('layouts.app')
@section('content')
 <div class="sticky z-20 bg-white rounded-xl p-10 w-1/2 my-10 mx-auto">
  <p class="text-2xl text-center mb-5">complete your profile</p>
 <form method="POST" action="{{route('profile.store')}}">
    @csrf
    <p class="text-xl">phone number</p>
    <input type="text" name="phone_number" required class="mx-auto w-3/4 h-10 rounded p-2 m-2 border-2 border-gray-600 focus:border-blue-500" >
    <p class="text-xl">city</p>
    <input type="text" name="city" required class="mx-auto w-3/4 h-10 rounded p-2 m-2 border-2 border-gray-600 focus:border-blue-500">
    <p class="text-xl">street</p>
    <input type="text" name="street" required class="mx-auto w-3/4 h-10 rounded p-2 m-2 border-2 border-gray-600 focus:border-blue-500">
  <div class="mx-10">
    <p class="text-2xl">this website wants to notify you <br> in which categories are you interested?</p>
    @isset($categories)
     @foreach ($categories as $category)
     <p class="text-2xl">
      <input type="checkbox" name="categories[]" value="{{$category->id}}" />
      <span class="m-2 text-2xl">{{$category->name}}</span>
     </p>
     @endforeach 
    @endisset
  <input type="submit" value="complete profile" class="cursor-pointer bg-green-600 text-2xl px-5 py-2 m-3 rounded text-white">
  </div>
 </form>    
 </div>
 <div class="absolute z-10 -inset-x-0 -inset-y-full bg-black opacity-50"></div>   
@endsection