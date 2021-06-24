<div>
  <ul class="flex list-style-none mx-5">
   @foreach ($categories as $category)
    <li class="px-2 py-1"><a href="{{route('product.specificproduct',$category->id)}}" class="capitalize text-blue-500 active:text-green-500 hover:text-green-500 text-xl lg:text-2xl xl:text-2xl 2xl:text-3xl">{{$category->name}}</a></li>   
   @endforeach    
  </ul> 
</div>