@extends('layouts.app')
@section('content')
@include('categorylink')
<div class="block lg:flex xl:flex 2xl:flex">
  <div class="w-full lg:w-2/3 xl:w-2/3 2xl:w-2/3 p-5">
    <div>
        <img src="/storage/products/{{$product->cover}}" class="w-full lg:w-3/4 xl:w-3/4 2xl:w-3/4">
        <p class="text-2xl mx-10">{{$product->name}} <strong>{{$product->price}} birr</strong></p>
        <p class="text-lg mx-10"> {{$product->description}}</p>
    </div>
    <div class="flex">
      <div>
        <report-component user-id="{{Auth::user()->id}}" product-id="{{$product->id}}"/>
      </div>
       @can('update',$product)
        <a href="{{route('product.edit',$product->id)}}" class="m-1 text-xl text-white bg-green-500 px-2 rounded cursor-pointer">edit</a>
       @endcan
       @can('delete',$product)
       <deleteproduct-component product-id="{{$product->id}}" /> 
       @endcan 
    </div>
     <comment-component user-id="{{Auth::user()->id}}" product-id="{{$product->id}}"/>    
   </div>
        <div class="m-2">
            @foreach ($recommendedProducts as $product)
              <div class="flex w-max m-2">
                <a href="{{route('product.show',$product->id)}}">
                  <img src="/storage/products/{{$product->cover}}" width="300px">
                </a>
                  <div class="mx-2">
                    <p class="text-xl text-center">{{$product->name}}</p>
                    <p class="text-xl text-center">{{$product->price}} birr</p>  
                    <addtocart-component product-id="{{$product->id}}" user-id="{{Auth::user()->id}}"/>
                  </div>   
             </div>
            @endforeach  
       </div>
</div>
@endsection