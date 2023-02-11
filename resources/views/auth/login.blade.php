@extends('layouts.log-temp')

@section('content')

<div class="d-lg-flex half">
    <div class="bg order-1 order-md-2" style="background-image: url('https://images.alphacoders.com/117/1174292.jpg');"></div>
    <div class="contents order-2 order-md-1">

      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-7">
            <div class="mb-4">
              <h3>{{ __('Login') }}</h3>
              <p class="mb-4">Lorem ipsum dolor sit amet elit. Sapiente sit aut eos consectetur adipisicing.</p>
            </div>

            <form action="{{ route('login') }}" method="post">
                @csrf
              <div class="form-group first">
                <label for="username">{{ _('Email Address') }}</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <div class="form-group last mb-3">
                <label for="password">{{ _('Password') }}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>

              <div class="d-flex mb-5 align-items-center">
                <label class="control control--checkbox mb-0"><span class="caption">{{ _('Remember me') }}</span>
                  <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}/>
                  <div class="control__indicator"></div>
                </label>
                <span class="ml-auto">
                    @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="forgot-pass">Forgot Password</a>
                    @endif
                    <a href="/register" class="forgot-pass">Register</a>
                </span>
              </div>

              <input type="submit" value="Log In" class="btn btn-block btn-primary">

              <span class="d-block text-center my-4 text-muted">&mdash; or &mdash;</span>

              <div class="social-login">
                <a href="auth/google" class="google btn d-flex justify-content-center align-items-center">
                  <span class="icon-google mr-3"></span> Login with  Google
                </a>
                <a href="auth/github" class="google btn d-flex justify-content-center align-items-center">
                  <span class="icon-github mr-3"></span> Login with  Github
                </a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>


  </div>
@endsection
