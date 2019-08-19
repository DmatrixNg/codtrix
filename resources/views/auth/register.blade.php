@extends('layouts.landing')

@section('content')
<div class="header-space"></div>
<!-- Header End -->
<!-- Breadcrumb Area Start -->
<nav class="breadcrumb-area bg-dark bg-6 ptb-70">
  <div class="container d-md-flex">
    <h2 class="text-white mb-0">Sign Up</h2>
    <ol class="breadcrumb p-0 m-0 bg-dark ml-auto">
      <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a> <span class="text-white">/</span></li>
      <li aria-current="page" class="breadcrumb-item active">{{ __('Register') }}</li>
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
          <form class="form-group mb-0" method="POST" action="{{ route('register') }}">
            @csrf

            <input class="form-control mb-25 @error('name') is-invalid @enderror"  id="name" type="text" name="name" value="{{ old('name') }}" required placeholder="Name" autocomplete="name" autofocus>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <input id="email" class="form-control mb-25 @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" required placeholder="Email" autocomplete="email">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <input id="password" class="form-control mb-25 @error('password') is-invalid @enderror" type="password" name="password" required placeholder="Password" autocomplete="new-password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <input id="password-confirm" class="form-control" type="password" name="password_confirmation" required placeholder="Confirm Password" autocomplete="new-password">
            <div class="custom-control custom-checkbox mr-sm-2 d-flex mt-30 mb-20">
              <input type="checkbox" class="custom-control-input" id="remember">
              <label class="custom-control-label ml-2" for="remember">You agree to our <a href="#">Terms of Service</a> & <a href="#">Privacy Policy.</a></label>
            </div>
            <button class="btn btn-primary w-100 mb-40" type="submit">{{ __('Register') }}</button>
          </form>
        </div>
        </div>
        </div>
        </div>
        </div>
        <!-- Login Area End -->
@endsection
