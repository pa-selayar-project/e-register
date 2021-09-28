@extends('layouts.app')

@section('title','Setting Aplikasi')

@section('tombol')
  {!!$back!!}
  <a href="setting/{{$data->id}}/edit" class="d-none d-sm-inline-block btn btn-sm btn-primary btn-icon-split rounded">
  <span class="icon text-white-50">
    <i class="fa fa-edit"></i>
  </span>
  <span class="text"> Edit</span>
</a>
@endsection

@section('content')
<div class="card shadow mb-4">
  <div class="card-body">
    <div class="col-lg-4 col-md-4">
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
    <div class="col-lg-4 col-md-4">
      <div class="card">
        <div class="card-header">
          <strong class="card-title mb-3">Background Login</strong>
        </div>
        <div class="card-body">
          <div class="mx-auto d-block">
            <img class="rounded mx-auto d-block" src="/assets/images/logo/{{$data->bgimage}}" height="250" width="300">
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-4">
      <div class="card">
        <div class="card-header">
          <strong class="card-title mb-3">Resume Aplikasi</strong>
        </div>
        <div class="card-body">
          <table class="table table-striped">
          <tbody>
            <tr>
              <td>Aplikasi {{$data->nama_aplikasi}}</td>
            </tr>
            <tr>
              <td>Versi {{$data->versi}}</td>
            </tr>
            <tr>
              <td>by {{$data->author}}</td>
            </tr>
            <tr>
              <td class="d-flex">
                <div class="mr-5">Favicon</div>
                <div>
                  <img class="rounded-circle mx-0 my-0 d-block" src="/assets/images/logo/{{$data->logo_kecil}}" height="64" width="64">
                </div>
              </td>
            </tr>
          </tbody>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

