@extends('layouts.app')

@section('title','Dashboard')


@section('breadcumb')
	@if(Auth::user()->level == 1)
		Admin : {{Auth::user()->name}}
	@else
		User : {{Auth::user()->name}}
	@endif
@endsection

@section('content')
<div class="col-lg-3 col-md-6">
	<div class="card">
		<div class="card-body">
			<div class="stat-widget-one">
				<div class="stat-icon dib"><i class="fas fa-user text-success border-success"></i></div>
				<div class="stat-content dib">
					<div class="stat-text"><a href="dashboard/pegawai">Daftar Pegawai</a></div>
					<div class="stat-digit">{{$pegawai}}</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="col-lg-3 col-md-6">
	<div class="card">
		<div class="card-body">
			<div class="stat-widget-one">
				<div class="stat-icon dib"><i class="ti-user text-primary border-primary"></i></div>
				<div class="stat-content dib">
					<div class="stat-text"><a href="dashboard/honorer">Daftar Honorer</a></div>
					<div class="stat-digit">{{$honorer}}</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="col-lg-3 col-md-6">
	<div class="card">
		<div class="card-body">
			<div class="stat-widget-one">
				<div class="stat-icon dib"><i class="fas fa-file text-warning border-warning"></i></div>
				<div class="stat-content dib">
					<div class="stat-text"><a href="register/regsk">Register SK</a></div>
					<div class="stat-digit">{{$sk}}</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="col-lg-3 col-md-6">
	<div class="card">
		<div class="card-body">
			<div class="stat-widget-one">
				<div class="stat-icon dib"><i class="ti-email text-danger border-danger"></i></div>
				<div class="stat-content dib">
					<div class="stat-text"><a href="register/surat_tugas">Surat Tugas</a></div>
					<div class="stat-digit">{{$st}}</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="col-md-6">
	<div class="card" style="height:22rem;">
		<div class="card-header">
			<strong class="card-title">Pesan Notifikasi <small><span class="badge badge-success float-right mt-1">90</span></small></strong>
		</div>
		<div class="card-body">
			<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
		</div>
	</div>
</div>

<div class="col-md-6">
	<div class="card" style="height:22rem;">
		<div class="card-header">
			<strong class="card-title">Log Activity <small><span class="badge badge-success float-right mt-1">34</span></small></strong>
		</div>
		<div class="card-body">
			<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
			
		</div>
	</div>
</div>
@endsection