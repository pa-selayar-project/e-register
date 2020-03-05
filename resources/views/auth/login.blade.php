@extends('auth.app')

@section('title', 'Login')

@section('content')
<div class="row">
  <div class="col-lg-6 d-none d-lg-block">
    <img src="{{url('assets/img/paselayar.png')}}" class="m-5 w-75" />
  </div>
  <div class="col-lg-6">
    <div class="p-5">

      <div class="text-center">
        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
      </div>

      <form class="user" method="post" action="{{route('login')}}">
        @csrf
        <div class="form-group">
          <input type="text" name="name" class="form-control form-control-user @error('name') is-invalid @enderror" id="name" placeholder="Username.." value="{{old('name')}}">

          @error('name')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <div class="form-group">
          <input type="password" name="password" class="form-control form-control-user @error('password') is-invalid @enderror" placeholder="Password" value="{{old('password')}}">

          @error('password')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <div class=" form-group">
          <div class="custom-control custom-checkbox small">
            <input type="checkbox" class="custom-control-input" id="customCheck">
            <label class="custom-control-label" for="customCheck">Remember Me</label>
          </div>
        </div>
        <button type="submit" class="btn btn-primary btn-user btn-block">
          Login
        </button>
      </form>

      <hr>
      <div class="text-center">
        <a class="small" href="{{route('password.request')}}">Forgot Password?</a>
      </div>
      <div class="text-center">
        <a class="small" href="{{route('register')}}">Create an Account!</a>
      </div>
    </div>
  </div>
</div>
@endsection