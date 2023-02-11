

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

            <form action="{{ route('register') }}" method="post">
                @csrf
              <div class="form-group first">
                <label for="username">{{ _('Username') }}</label>
                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
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
              <div class="form-group last mb-3">
                <label for="password">{{ _('Password Confirm') }}</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>


              <input type="submit" value="Register" class="btn btn-block btn-primary">

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

