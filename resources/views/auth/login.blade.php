@extends('layouts.landing')

@section('content')
  <div class="header-space"></div>
  <!-- Header End -->
  <!-- Breadcrumb Area Start -->
  <nav class="breadcrumb-area bg-dark bg-6 ptb-70">
    <div class="container d-md-flex">
      <h2 class="text-white mb-0">Sign In</h2>
      <ol class="breadcrumb p-0 m-0 bg-dark ml-auto">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a> <span class="text-white">/</span></li>
        <li aria-current="page" class="breadcrumb-item active">{{ __('Login') }}</li>
      </ol>
    </div>
  </nav>
  <!-- Breadcrumb Area End -->
  <!-- Login Area Start -->
  <div class="section-ptb">
    <div class="container">
      <div class="row">
        <div class="col-12 col-sm-10 col-md-8 col-lg-6 mx-auto">
          <div class="sign-form">
            <form class="form-group mb-0" method="POST" action="{{ route('login') }}">
                @csrf
              <input id="email" class="form-control mb-25 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="{{ __('E-Mail Address') }}" required autocomplete="email" autofocus>
              @error('email')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
              <input id="password" class="form-control @error('password') is-invalid @enderror" type="password" name="password" required autocomplete="current-password">
              @error('password')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
              <div class="custom-control custom-checkbox mr-sm-2 d-flex mt-30 mb-20">
                <input type="checkbox" class="custom-control-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="custom-control-label ml-2" for="remember">{{ __('Remember Me') }}</label>
                <span class="ml-auto">
                  @if (Route::has('password.request'))
                  <a href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                  @endif
                </span>
              </div>
              <button class="btn btn-primary w-100 mb-40" type="submit">Log In</button>
              <p class="text-center mb-0">Don't have an account? <a href="{{ route('register') }}">Register Now</a></p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Login Area End -->
@endsection
