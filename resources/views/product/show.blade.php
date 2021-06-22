@extends('layouts.app')
@section('content')
<div class="block lg:flex xl:flex 2xl:flex">
  <div class="w-full lg:w-2/3 xl:w-2/3 2xl:w-2/3 p-5">
    <div>
        <img src="/storage/products/{{$product->cover}}" class="w-100">
        <p class="text-2xl mx-10">{{$product->name}} <strong>{{$product->price}} birr</strong></p>
        <p class="text-lg mx-10"> {{$product->description}}</p>
    </div>
    <div class="flex">
      <div>
        <report-component user-id="{{Auth::user()->id}}" product-id="{{$product->id}}"/>
      </div>
       @can('update',$product)
        <a href="{{route('product.edit',$product->id)}}" class="m-2 text-xl text-white bg-blue-500 px-2 rounded cursor-pointer">edit</a>
       @endcan
       @can('delete',$product)
       <form method="POST" action="{{route('product.delete',$product->id)}}">
        @csrf
        @method('delete')
        <input type="submit" value="delete" class="m-2 text-xl bg-red-500 text-white px-2 rounded cursor-pointer">
       </form> 
       @endcan 
    </div>
     <comment-component user-id="{{Auth::user()->id}}" product-id="{{$product->id}}"/>    
   </div>
        <div class="">
            @foreach ($recommendedProducts as $product)
                <a href="{{route('product.show',$product->id)}}">
                    <div class="flex w-max m-2">
                        <img src="/storage/products/{{$product->cover}}" width="300px">
                        <div>
                          <p class="text-xl text-center">{{$product->name}}</p>
                          <p class="text-xl text-center">{{$product->price}} birr</p>  
                          <addtocart-component product-id="{{$product->id}}" user-id="{{Auth::user()->id}}"/>
                          <a href="{{route('product.show',$product->id)}}">details</a>
                    </div>   
                </a>
                </div>
            @endforeach  
       </div>
</div>
@endsection