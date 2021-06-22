@extends('layouts.app')
@section('content')
<div class="block lg:flex xl:flex 2xl:flex">
  <div class="w-full lg:w-2/3 xl:w-2/3 2xl:w-2/3 p-5">
    <div>
        <p class="text-xl mx-10">{{$product->name}}</p>
        <img src="/storage/products/{{$product->cover}}" class="w-100 m-2">
        <p class="text-xl mx-10">price {{$product->price}} birr</p>
        <p class="text-xl mx-10"> {{$product->description}}</p>
        <report-component user-id="{{Auth::user()->id}}" product-id="{{$product->id}}"/>
    </div>
    {{-- <div>
       @can('update', Product::class)
       <form method="POST" action="{{route('product.update',$product->id)}}">
        {{csrf_field}}
        @method('update')
        <input type="submit" value="edit">
       </form> 
       @endcan
       @can('delete', Product::class)
       <form method="POST" action="{{route('product.delete',$product->id)}}">
        {{csrf_field}}
        @method('delete')
        <input type="submit" value="delete">
       </form> 
       @endcan 
    </div> --}}
     <comment-component user-id="{{Auth::user()->id}}" product-id="{{$product->id}}"/>    
   </div>
        <div class="">
            @foreach ($recommendedProducts as $product)
                <a href="{{route('product.show',$product->id)}}">
                    <div class="flex w-max m-2">
                        <img src="/storage/products/{{$product->cover}}" alt="" width="200px">
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