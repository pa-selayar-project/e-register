@extends('auth.app')

@section('title', 'Register')

@section('content')
<div class="row">
  <div class="col-lg-5 d-none d-lg-block">
    <img src="{{url('assets/img/paselayar.png')}}" class="m-5 w-75" />
  </div>
  <div class="col-lg-7">
    <div class="p-5">
      <div class="text-center">
        <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
      </div>

      <form method="POST" action="{{route('register')}}" class="user">
        @csrf
        <div class="form-group">
          <input type="text" name="name" id="name" class="form-control form-control-user @error('name') is-invalid @enderror" value="{{old('name')}}" placeholder="Username">

          @error('name')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <div class="form-group">
          <input type="email" name="email" id="email" class="form-control form-control-user @error('email') is-invalid @enderror" placeholder="Email Address" value="{{old('email')}}">

          @error('email')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <div class="form-group row">
          <div class="col-sm-6 mb-3 mb-sm-0">
            <input type="password" name="password" id="password" class="form-control form-control-user @error('password') is-invalid @enderror" placeholder="Password" value="{{old('password')}}">
          </div>

          @error('password')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror

          <div class="col-sm-6">
            <input type="password" name="password_confirmation" class="form-control form-control-user" required autocomplete="new-password" placeholder="Repeat Password">
          </div>

        </div>
        <button type="submit" class="btn btn-primary btn-user btn-block">
          Register Account
        </button>
      </form>

      <hr>

      <div class="text-center">
        <a class="small" href="{{route('password.request')}}">Forgot Password?</a>
      </div>

      <div class="text-center">
        <a class="small" href="{{route('login')}}">Already have an account? Login!</a>
      </div>

    </div>
  </div>
</div>
@endsection