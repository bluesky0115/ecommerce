@extends('layouts.app')
@section('content')
  <div>
   <p class="">{{session('reportMessage')}}</p>   
   @forelse ($reports as $report)
    <div>
        <h1>reported by: </h1>
        <p>{{$report->user->name}}</p>
        <p>email: {{$report->user->email}}</p>
        <h1>reported product</h1>
        <img src="/products/{{$product->id}}" alt="">
        <p>product name: {{$product->name}}</p>
        <p>price: {{$product->price}} birr</p>
        <p>added by: {{$product->user->name}}</p>
        <p>description</p>
        <p>{{$product->description}}</p>
        <form method="POST" action="{{route('report.remove',$report->id)}}">
        {{ csrf_field() }}
        <input type="submit" class="">
        </form>     
    </div>  
   @empty
    <p class="">no products are reported yet</p>   
   @endforelse    
  </div>  
@endsection