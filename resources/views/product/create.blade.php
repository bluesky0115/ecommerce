@extends('layouts.app')
@section('content')
  <div class="w-full md:w-2/3 lg:w-1/2 xl:w-1/2 bg-white my-5 mx-auto py-5 px-10 rounded-xl">
    <p class="text-2xl m-2 font-semibold text-center">add product here</p>
     <form method="post" action="{{route('product.store')}}" enctype="multipart/form-data">
       {{ csrf_field() }}
       <input type="hidden" name="userId" value="{{Auth::user()->id}}">
       <p class="text-xl my-2 mx-5">product name</p>
       <input type="text" name="name" placeholder="product name" required class="mx-auto w-3/4 h-10 rounded p-2 m-2 border-2 border-gray-600 focus:border-blue-500">
       @if ($errors->has('name'))
        <p class="text-xl text-red-700 bg-red-200 w-max p-1">{{$errors->first('name')}}</p>
       @endif
       <p class="text-xl my-2 mx-5">product category</p>
       <select name="categoryId" id="" required class="mx-2 text-xl px-3 py-1 rounded">
         <option value="category" selected disabled>category</option>
         @foreach ($categories as $category)
             <option value="{{$category->id}}">{{$category->name}}</option>
         @endforeach
       </select>
       @if ($errors->has('category'))
        <p class="text-xl text-red-700 bg-red-200 w-max p-1">{{$errors->first('category')}}</p>
       @endif
        <p class="text-xl my-2 mx-5 ">product cost in birr</p>
        <input type="number" min="0" name="price" placeholder="product cost" required class="mx-auto w-3/4 h-10 rounded p-2 m-2 border-2 border-gray-600 focus:border-blue-500">
       @if ($errors->has('cost'))
        <p class="text-xl text-red-700 bg-red-200 w-max p-1">{{$errors->first('cost')}}</p>
       @endif
        <p class="text-xl my-2 mx-5">product image</p>
        <input type="file" name="photo" required>
       @if ($errors->has('photo'))
        <p class="text-xl text-red-700 bg-red-200 w-max p-1">{{$errors->first('photo')}}</p>
       @endif
       <p class="text-xl my-2 mx-5">description</p>
       <textarea name="description" class="rounded-lg w-full h-40 p-2 text-xl border-2 border-gray-600 focus:border-blue-500"></textarea>
       <input type="submit" value="sell product" class="cursor-pointer text-xl text-white py-1 px-3 rounded bg-green-500">
    </form>    
   </div>   
@endsection