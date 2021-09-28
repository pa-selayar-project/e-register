@extends('layouts.app')

@section('title','Profil User')

@section('breadcumb')
  {!!$back!!}
@endsection

@section('content')
<div class="card shadow mb-4">
  <div class="card-body">
    <div class="col-lg-6 col-md-6">
      <div class="card">
        <div class="card-header">
          <strong class="card-title mb-3">Profil User</strong>
        </div>
        <div class="card-body">
          <div class="mx-auto d-block">
            <img class="rounded-circle mx-auto d-block" src="/assets/pic/{{$data->foto}}" height="250" width="250">
            <h5 class="text-sm-center mt-2 mb-1">{{ucfirst($data->nama)}}</h5>
            <div class="location text-sm-center"><i class="fa fa-mail"></i> {{$data->email}}</div>
          </div><hr>
          <div class="card-text text-sm-center">
            Pengadilan Agama Selayar
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-6 col-md-6">
      <div class="card">
        <div class="card-header">
          <strong class="card-title mb-3">Resume</strong>
        </div>
        <div class="card-body">
          <ul class="list-group list-group-flush">
            <li class="list-group-item">
              <i class="fa fa-sitemap"></i> Level : {{($data->level==1)?'Admin':'User'}} 
            </li>
            <li class="list-group-item">
              <i class="fa fa-tasks"></i> Activity Logs : {{$data->log}} aktifitas
            </li>
            <li class="list-group-item">
              <i class="fa fa-bell"></i> Join Since : {{$data->join}}
            </li>
            <li class="list-group-item">
              <a href="#"> <i class="fa fa-comments"></i> Message <span class="badge badge-warning pull-right r-activity">03</span></a>
            </li>
            <li class="list-group-item">
              <a href="#"> <i class="fa fa-cog"></i> Settings</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

