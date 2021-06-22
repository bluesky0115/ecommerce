@extends('layouts.app')
@section('content')
 <div class="bg-white rounded-xl p-5 w-1/2 m-auto">
  <p class="text-2xl m-2 font-bold">edit product here</p>
   <form method="post" action="{{route('product.store')}}" enctype="multipart/form-data">
     {{csrf_field()}}
     <input type="hidden" value="{{Auth::user()->id}}">
     <p class="text-xl text-bold">product name</p>
     <input type="text" name="name" placeholder="product name" value="{{$product->name}}">
     @if ($errors->has('name'))
      <p class="text-xl text-red-700 bg-red-200 w-max p-1">{{$errors->first('name')}}</p>
     @endif
     <p class="text-xl text-bold">product category</p>
     <select name="category" class="text-xl" required>
       <option value="category" disabled>category</option>
       @foreach ($categories as $category)
           @if ($product->category->id==$category->id)
           <option value="{{$category->id}}" selected>{{$category->name}}</option>
           @endif
           <option value="{{$category->id}}">{{$category->name}}</option>
       @endforeach
     </select>
     @if ($errors->has('category'))
      <p class="text-xl text-red-700 bg-red-200 w-max p-1">{{$errors->first('category')}}</p>
     @endif
     <p class="text-xl text-bold">product cost in birr</p>
     <input type="number" step="any" value="{{$product->cost}}" min="0" name="cost" placeholder="product cost" required>
     @if ($errors->has('cost'))
      <p class="text-xl text-red-700 bg-red-200 w-max p-1">{{$errors->first('cost')}}</p>
     @endif
     <p class="text-xl text-bold">product photo</p>
     <img src="{{$product->photo}}" alt="" width="200px">
     <input type="file" name="photo">
     @if ($errors->has('photo'))
      <p class="text-xl text-red-700 bg-red-200 w-max p-1">{{$errors->first('photo')}}</p>
     @endif
     <p class="text-xl">description</p>
     <textarea name="description" value="{{$product->description}}" class=""></textarea>
     <input type="submit" value="edit product" class="bg-blue-500 text-white text-xl rounded px-2">
  </form>    
 </div>   
@endsection