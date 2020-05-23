@extends('auth.app')

@section('title', 'Reset Password')

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
        <form method="POST" action="{{ route('password.update') }}">
					@csrf
					<input type="hidden" name="token" value="{{ $token }}">

					<div class="form-group row">
						<label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

						<div class="col-md-6">
							<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

							@error('email')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
						</div>
					</div>

					<div class="form-group row">
						<label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

						<div class="col-md-6">
							<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

							@error('password')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
						</div>
					</div>

					<div class="form-group row">
						<label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

						<div class="col-md-6">
							<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
						</div>
					</div>

					<div class="form-group row mb-0">
						<div class="col-md-6 offset-md-4">
							<button type="submit" class="btn btn-primary">{{ __('Reset Password') }}</button>
						</div>
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