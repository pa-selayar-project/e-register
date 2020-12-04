@extends('layouts.app')

@section('title','Setting Aplikasi')

@section('breadcumb')
<a href="setting/{{$data->id}}/edit" class="d-none d-sm-inline-block btn btn-sm btn-primary btn-icon-split rounded mr-1">
  <span class="icon text-white-50">
    <i class="fa fa-edit"></i>
  </span>
  <span class="text"> Edit</span>
</a>
<a href="{{url('settings')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary btn-icon-split rounded mr-1">
  <span class="icon text-white-50">
    <i class="fa fa-chevron-circle-left"></i>
  </span>
</a>
@endsection

@section('content')
<div class="card shadow mb-4">
  <div class="card-body">
    <div class="col-lg-6 col-md-6">
      <div class="card">
        <div class="card-header">
          <strong class="card-title mb-3">Logo Aplikasi</strong>
        </div>
        <div class="card-body">
          <div class="mx-auto d-block">
            <img class="rounded-circle mx-auto d-block" src="/assets/images/logo/{{$data->logo_besar}}" height="250" width="250">
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-6 col-md-6">
      <div class="card">
        <div class="card-header">
          <strong class="card-title mb-3">Resume Aplikasi</strong>
        </div>
        <div class="card-body">
          <table class="table table-striped">
          <tbody>
            <tr>
              <td>Nama Aplikasi</th>
              <td>:</td>
              <td>{{$data->nama_aplikasi}}</td>
            </tr>
            <tr>
              <td>Versi</th>
              <td>:</td>
              <td>{{$data->versi}}</td>
            </tr>
            <tr>
              <td>Author</th>
              <td>:</td>
              <td>{{$data->author}}</td>
            </tr>
            <tr>
              <td>Small Logo</th>
              <td>:</td>
              <td>
                <img class="rounded-circle mx-auto d-block" src="/assets/images/logo/{{$data->logo_kecil}}" height="80" width="80">
              </td>
            </tr>
          </tbody>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

