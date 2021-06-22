<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="icon" href="https://www.google.com/url?sa=i&url=https%3A%2F%2Ficons-for-free.com%2Fcart%2Becommerce%2Bshop%2Bicon-1320166083122274571%2F&psig=AOvVaw2_4410cN2jnrmeFPNRJIFi&ust=1624431066987000&source=images&cd=vfe&ved=0CAcQjRxqFwoTCKCJ47zTqvECFQAAAAAdAAAAABAE">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-200">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-gray-700 shadow-sm flex text-white">
            <div class="flex">
                <a class="text-xl text-white m-1" href="{{route('home')}}">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                  </svg>
                </a>
                <form action="{{route('product.search')}}" class="w-full flex ml-5 px-2">
                 <input type="text" name="searchQuery" required class="text-gray-700 h-4/5 my-auto w-1/2 rounded border-2 border-gray-500 text-xl py-1 px-3 mx-1">
                 <select name="category" id="" required class="my-auto bg-gray-700 text-xl text-white">
                    <option value="all" selected>all</option>
                    @foreach ($categories as $category)
                      <option value="{{$category->id}}">{{$category->name}}</option>  
                    @endforeach  
                  </select>
                 <input type="submit" value="search" class="text-xl text-white bg-gray-700">    
                </form> 
                  <a href="{{route('product.create')}}" class="text-xl mx-2">add</a>
                  <a href="{{route('order')}}" class="text-xl mx-2">order</a>
                  <a href="{{route('about')}}" class="text-xl mx-2">contact us</a>
                  <div>
                    @auth
                    <cart-component user-id="{{Auth::user()->id}}">   
                    @endauth    
                  </div>    
                   @auth
                   <div>
                    @auth
                    <notifications-component user-id="{{Auth::user()->id}}"/>   
                    @endauth    
                   </div>  
                   @endauth 
               </ul>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="flex collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
    

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="text-xl text-white mx-1" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="text-xl text-white mx-1" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="text-xl text-white mx-1 dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class=" py-1">
            @yield('content')
        </main>
    </div>
</body>
</html>