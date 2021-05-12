@extends('layouts.app')
@section('content')
 <div>
  <p class="text-2xl m-2 font-bold">add product here</p>
   <form methos="post" action="{{route('product.store')}}" enctype="multipart/form-data">
     <input type="hidden" value="{{Auth::user()->id}}">
     <label for="name" class="text-xl text-bold">product name</label>
     <input type="text" name="name" placeholder="product name">
     @if ($errors->has('name'))
      <p class="text-xl text-red-700 bg-red-200 w-max p-1">{{$errors->first('name')}}</p>
     @endif
     <label for="category" class="text-xl text-bold">product category</label>
     <select name="category" id="" required>
       <option value="category" selected disabled>category</option>
       @foreach ($categories as $category)
           <option value="{{$category->id}}">{{$category->name}}</option>
       @endforeach
     </select>
     @if ($errors->has('category'))
      <p class="text-xl text-red-700 bg-red-200 w-max p-1">{{$errors->first('category')}}</p>
     @endif
     <label for="cost" class="text-xl text-bold">product cost in birr</label>
     <input type="number" step="any" min="0" name="cost" placeholder="product cost" required>
     @if ($errors->has('cost'))
      <p class="text-xl text-red-700 bg-red-200 w-max p-1">{{$errors->first('cost')}}</p>
     @endif
     <label for="photo" class="text-xl text-bold">product photo</label>
     <input type="file" name="photo" required>
     @if ($errors->has('photo'))
      <p class="text-xl text-red-700 bg-red-200 w-max p-1">{{$errors->first('photo')}}</p>
     @endif
     <label for="description">description</label>
     <textarea name="description" id="" cols="30" rows="10"></textarea>
     <input type="submit" value="sell product">
  </form>    
 </div>   
@endsection