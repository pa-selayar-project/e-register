@extends('layouts.app')

@section('title','Info Satker')

@section('breadcumb')
<a href="{{url('settings')}}" class="ml-1 d-none d-sm-inline-block btn btn-sm btn-danger">
  <span class="icon text-white">
    <i class="fas fa-arrow-alt-circle-left"></i>
  </span>
</a>
@endsection

@section('content')
<div class="card shadow mb-4">
  <div class="card-body">
    <div class="col-lg-6 col-md-6">
      <div class="card">
        <div class="card-header">
          <strong class="card-title mb-3">Resume PTA Satker</strong>
          <a href="{{url('settings/pta')}}" class="btn btn-sm btn-secondary rounded float-right">Daftar PTA</a>
        </div>
        <div class="card-body ml-3">
          <div class="row mb-2 font-weight-bold">
            {{$pta->nama_pta}}</div>
          <div class="row mb-2">
            {{$pta->alamat}}
          </div>
          <div class="row mb-5">
            
          </div>
          
          <hr>
          
          <div class="row mb-2">
            <div class="col-md-4">Ketua</div>
            <div class="col-md-8">{{$pejabat->ketua}}</div>
          </div>
          <div class="row mb-2">
            <div class="col-md-4">Wakil Ketua</div>
            <div class="col-md-8">{{$pejabat->wakil_ketua}}</div>
          </div>
          <div class="row mb-2">
            <div class="col-md-4">Plh. Ketua</div>
            <div class="col-md-8">{{$pejabat->plh_ketua}}</div>
          </div>
          <div class="row my-2">
            <div class="col-md-4">
              
            </div>
            <div class="col-md-8"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-6 col-md-6">
      <div class="card">
        <div class="card-header">
          <strong class="card-title mb-3">Satuan Kerja</strong>
        </div>
        <div class="card-body ml-3">
          <div class="row mb-2 font-weight-bold">Pengadilan Agama Selayar</div>
          <div class="row mb-2">
           Jln. Jend. Ahmad Yani No. 133 Benteng, Kabupaten Kepulauan Selayar
          </div>
          <hr>
          <div class="row mb-2">
            <div class="col-md-4">Ketua</div>
            <div class="col-md-8">Dr. Hj. Aisyah Ismail, S.H., M.H.</div>
          </div>
          <div class="row mb-2">
            <div class="col-md-4">Wakil Ketua</div>
            <div class="col-md-8">Dr. H. Nurdin Juddah, S.H., M.H.</div>
          </div>
          <div class="row mb-2">
            <div class="col-md-4">Plh. Ketua</div>
            <div class="col-md-8">Fulan</div>
          </div>
          <div class="row mb-2">
            <a href="#" class="btn btn-primary mr-2" data-toggle="modal" data-target="#pta">Edit Pejabat PTA</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script src="{{url('vendors/jquery/dist/jquery.min.js')}}"></script>
@endsection