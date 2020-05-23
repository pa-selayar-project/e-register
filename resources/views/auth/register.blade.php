@extends('auth.app')

@section('title', 'Register')

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
<?php $data = \App\Setting::where('id',1)->first();?>
<div class="sufee-login d-flex align-content-center flex-wrap">
  <div class="container">
    <div class="login-content">
      <div class="login-logo">
        <img class="align-content" src="{{url('assets/images/logo/'.$data->logo_besar)}}" width="150" height="200">
        <div class="text-white"><h2>{{$data->nama_aplikasi}} V {{$data->versi}}</h2></div>
      </div>
      <div class="login-form">
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