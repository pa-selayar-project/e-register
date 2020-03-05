@extends('layouts.app')

@section('title','Dashboard')


@section('breadcumb')
	<li class="active">Dashboard</li>
@endsection

@section('content')
<h1>Selamat Datang {{ucfirst(Auth::user()->name)}}</h1>
@endsection