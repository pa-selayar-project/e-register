@extends('layouts.app')

@section('title','Profil User')

@section('breadcumb')
<a href="profil/{{$data->id}}/edit" class="d-none d-sm-inline-block btn btn-sm btn-primary btn-icon-split rounded mr-1">
  <span class="icon text-white-50">
    <i class="fa fa-edit"></i>
  </span>
  <span class="text"> Edit</span>
</a>
<a href="profil/ubah_password" class="d-none d-sm-inline-block btn btn-sm btn-warning btn-icon-split rounded">
  <span class="icon text-white-50">
    <i class="fa fa-retweet"></i>
  </span>
  <span class="text"> Ubah Password</span>
</a>
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
            <img class="rounded-circle mx-auto d-block" src="/assets/pic/{{$data->image}}" height="250" width="250">
            <h5 class="text-sm-center mt-2 mb-1">{{ucfirst($data->name)}}</h5>
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
              <i class="fa fa-tasks"></i> Activity Logs
            </li>
            <li class="list-group-item">
              <i class="fa fa-bell"></i> Join Since : {{\App\Helpers\Helper::tanggal_id(strtotime($data->created_at))}}
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

