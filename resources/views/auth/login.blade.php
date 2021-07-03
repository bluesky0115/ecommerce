@extends('layouts.app')
@section('content')
<div class="bg-white p-14 my-5 w-1/2 mx-auto rounded-xl">
 <form method="POST" action="{{ route('login') }}">
 @csrf
 <p class="text-xl">Email adress</p>
  <input id="email" type="email" class="form-control mx-auto w-3/4 h-10 rounded p-2 m-2 border-2 border-gray-600 focus:border-blue-500 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
   @error('email')
   <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
   </span>
   @enderror
   <p class="text-xl">Password</p>
    <input id="password" type="password" class="form-control mx-auto w-3/4 h-10 rounded p-2 m-2 border-2 border-gray-600 focus:border-blue-500 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
    @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
    <p class="form-check-label text-xl" for="remember">
        {{ __('Remember Me') }}
        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
    </p>
    <button type="submit" class="bg-green-500 text-2xl text-white px-5 py-1 mx-5 my-3 rounded">
        {{ __('Login') }}
    </button>
    @if (Route::has('password.request'))
     <p class="text-xl">
        <a class="btn btn-link" href="{{ route('password.request') }}">
            {{ __('Forgot Your Password?') }}
        </a>
     </p>   
    @endif
</form>
</div>
@endsection
