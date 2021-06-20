@extends('layouts.app')
@section('content')
 <div class="bg-gray-200 p-10 -inset-full">
  <div class="w-1/2 bg-white m-auto py-5 px-10 rounded-xl">
    <p class="text-2xl m-2 font-semibold text-center">add product here</p>
     <form method="post" action="{{route('product.store')}}" enctype="multipart/form-data">
       {{ csrf_field() }}
       <input type="hidden" value="{{Auth::user()->id}}">
       <p class="text-xl my-2 mx-5">product name</p>
       <input type="text" name="name" placeholder="product name" required class="mx-auto w-3/4 h-10 rounded p-2 m-2">
       @if ($errors->has('name'))
        <p class="text-xl text-red-700 bg-red-200 w-max p-1">{{$errors->first('name')}}</p>
       @endif
       <p class="text-xl my-2 mx-5">product category</p>
       <select name="category" id="" required class="text-xl">
         <option value="category" selected disabled>category</option>
         @foreach ($categories as $category)
             <option value="{{$category->id}}">{{$category->name}}</option>
         @endforeach
       </select>
       @if ($errors->has('category'))
        <p class="text-xl text-red-700 bg-red-200 w-max p-1">{{$errors->first('category')}}</p>
       @endif
        <p class="text-xl my-2 mx-5 ">product cost in birr</p>
        <input type="number" step="any" min="0" name="cost" placeholder="product cost" required>
       @if ($errors->has('cost'))
        <p class="text-xl text-red-700 bg-red-200 w-max p-1">{{$errors->first('cost')}}</p>
       @endif
        <p class="text-xl my-2 mx-5">product image</p>
        <input type="file" name="photo" required>
       @if ($errors->has('photo'))
        <p class="text-xl text-red-700 bg-red-200 w-max p-1">{{$errors->first('photo')}}</p>
       @endif
       <p class="text-xl my-2 mx-5">description</p>
       <textarea name="description" class="w-full h-40 p-2 text-xl"></textarea>
       <input type="submit" value="sell product" class="cursor-pointer text-xl text-white py-1 px-3 rounded bg-gray-700">
    </form>    
   </div>   
 </div>
@endsection