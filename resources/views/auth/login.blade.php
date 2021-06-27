@extends('layouts.app')
@section('content')
<div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left p-5">
                <div class="brand-logo">
                  <img src="https://sehat.com.pk/product_images/sehattmlogo.png">
                </div>
                <h4>Hello! let's get started</h4>
                <h6 class="font-weight-light">Sign in to continue.</h6>
                <form class="pt-3" method="post" action="{{ route('login') }}">
                    {{ csrf_field() }}
                  <div class="form-group">
                    <input type="text" class="form-control {{ $errors->has('username') || $errors->has('email') ? ' form-control-danger' : '' }} form-control-lg" id="exampleInputEmail1" name="login" value="{{ old('username') ?: old('email') }}" placeholder="Username / Email">
                    @if ($errors->has('username') || $errors->has('email'))
                    <label id="cemail-error" class="error mt-2 text-danger" for="cemail">{{ $errors->first('username') ?: $errors->first('email') }}</label>
                   @endif
                  </div>
                  <div class="form-group">
                    <input type="password" name="password" class="form-control {{  $errors->has('password') ? 'form-control-danger' : '' }} form-control-lg" id="exampleInputPassword1" placeholder="Password">
                      @if ($errors->has('password'))
                      <label id="cemail-error" class="error mt-2 text-danger" for="cemail">{{   $errors->first('password') }}</label>
                   @endif
                  </div>
                   <div class="my-2 d-flex justify-content-between align-items-center">
                    <div class="form-check">
                      <label class="form-check-label text-muted">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} class="form-check-input"> Remember Me </label>
                    </div>
                    @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="auth-link text-black">Forgot password?</a>
                    @endif
                  </div>
                  <div class="mt-3">
                    <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                  </div>
                  
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
@endsection