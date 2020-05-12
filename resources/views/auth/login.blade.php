@extends('auth.app')

@section('title', 'Login')

@section('stylesheet')
  <link rel="apple-touch-icon" href="apple-icon.png">
  <link rel="shortcut icon" href="favicon.ico">

  <link rel="stylesheet" href="{{url('vendors/bootstrap/dist/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{url('vendors/font-awesome/css/font-awesome.min.css')}}">
  <link rel="stylesheet" href="{{url('vendors/themify-icons/css/themify-icons.css')}}">
  <link rel="stylesheet" href="{{url('vendors/flag-icon-css/css/flag-icon.min.css')}}">
  <link rel="stylesheet" href="{{url('vendors/selectFX/css/cs-skin-elastic.css')}}">

  <link rel="stylesheet" href="{{url('assets/css/style.css')}}">

  <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
@endsection

@section('content')
<div class="sufee-login d-flex align-content-center flex-wrap">
  <div class="container">
    <div class="login-content">
      <div class="login-logo">
        <img class="align-content" src="images/logo.png" alt="">
      </div>
      <div class="login-form">
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
          <div class="checkbox">
            <label>
              <input type="checkbox"> Remember Me
            </label>
            <label class="pull-right">
              <a href="{{route('password.request')}}">Forgotten Password?</a>
            </label>
          </div>
          <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
          <div class="register-link m-t-15 text-center">
            <p>Don't have account ? <a href="{{route('register')}}"> Sign Up Here</a></p>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
  <script src="{{url('vendors/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{url('vendors/popper.js/dist/umd/popper.min.js')}}"></script>
  <script src="{{url('vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
  <script src="{{url('assets/js/main.js')}}"></script>
@endsection