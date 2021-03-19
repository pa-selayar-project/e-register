@extends('layouts.app')

@section('title','Dashboard')


@section('breadcumb')
@if(Auth::user()->id_level == 1)
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
	<div class="card" style="height:330px;">
		<div class="card-header">
			<strong class="card-title">Pesan Notifikasi
				@if($hitungnotif > 4)
				<a href="#" class="text-success"> [Selengkapnya]</a>
				@endif
				<small>
					@if($hitungnotif)
						<span class="badge badge-success float-right mt-1">
							{{$hitungnotif}}
						</span>
					@endif
				</small>
			</strong>
		</div>
		<div class="card-body">
			@if(!$hitungnotif)
				<p>Tidak ada Data Notifikasi</p>
			@endif
			<ul class="list-group list-group-flush">
				@foreach($notif as $n)
				<li class="list-group-item text-justify">
					@if(date('Y',$n->kgb_yad) == date('Y'))
						Pegawai An. <strong>{{$n->nama_pegawai}}</strong> akan KGB pada <strong>{{\App\Helpers\Helper::tanggal_id($n->kgb_yad)}}</strong>
					@elseif(date('Y',$n->kp_yad) == date('Y'))
						Pegawai An. <strong>{{$n->nama_pegawai}}</strong> akan Naik Pangkat pada <strong>{{\App\Helpers\Helper::tanggal_id($n->kp_yad)}}</strong>
					@endif
				</li>
				@endforeach
			</ul>
		</div>
	</div>
</div>

<div class="col-md-6">
	<div class="card" style="height:330px;">
		<div class="card-header">
			<strong class="card-title">Log Activity
				@if($hitunglog > 6)
				<a href="/log" class="text-success"> [Selengkapnya]</a>
				@endif
				<small>
					<span class="badge badge-success float-right mt-1">{{$hitunglog}}</span>
				</small>
			</strong>
		</div>
		<div class="card-body">
			<ul class="list-group list-group-flush">
				@foreach($logs as $log)
				<li class="list-group-item text-justify">
					User <strong>{{ucfirst($log->user->name)}}</strong> {{$log->pesan_log}} pada <strong>{{\App\Helpers\Helper::tanggal_id(date(strtotime($log->created_at)))}}</strong>;
				</li>
				@endforeach
			</ul>

		</div>
	</div>
</div>
@endsection