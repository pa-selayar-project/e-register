@extends('layouts.app')

@section('title','Rekam Surat Cuti')

@section('breadcumb')
<a href="javascript:history.back();" class="d-none d-sm-inline-block btn btn-sm btn-primary btn-icon-split rounded mr-1">
  <span class="icon text-white-50">
    <i class="fa fa-chevron-circle-left"></i>
  </span>
</a>
@endsection

@section('stylesheet')
<link rel="stylesheet" href="{{url('vendors/chosen/chosen.css')}}">
<link rel="stylesheet" href="{{url('asset/css/jquery-ui.css')}}">
@endsection

@section('content')
<form method="post" action="{{url('register/surat_cuti')}}">
@csrf
<div class="row">
    <div class="col-xl-6 col-lg-6">  
      <div class="card shadow mb-4 h-100">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Data Surat Cuti</h6>
        </div>   
        <div class="card-body">
          <div class="form-group row">
            <label for="no_cuti" class="col-sm-3 col-form-label">Nama Pegawai</label>
            <div class="col-sm-9">
              <div class="input-group">
                <select name="pegawai_id" class="chosen-select form-control">
                  @foreach($pegawai as $p)
                  <option value="{{$p->id}}">{{$p->nama_pegawai}}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label for="tgl_cuti" class="col-sm-3 col-form-label">Tanggal</label>
            <div class="col-sm-9">
              <div class="input-group date">
                <input type="text" id="tgl_cuti" name="tgl_cuti" class="datepicker form-control">
                <div class="input-group-append">
                  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label for="mulai" class="col-sm-3 col-form-label">Tanggal Cuti</label>
            <div class="col-sm-9">
              <div class="input-group date">
                <input type="text" id="mulai" name="mulai" class="datepicker form-control"> 
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon3">s/d</span>
                  </div> 
                <input type="text" id="akhir" name="akhir" class="datepicker form-control">
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label for="alamat" class="col-sm-3 col-form-label">Alamat Cuti</label>
            <div class="col-sm-9">
              <textarea name="alamat" id="alamat" class="form-control" rows="3"></textarea>
            </div>
          </div>
          <div class="form-group row">
            <label for="alasan" class="col-sm-3 col-form-label">Alasan Cuti</label>
            <div class="col-sm-9">
              <textarea name="alasan" id="alasan" class="form-control" rows="3"></textarea>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-lg-3">  
      <div class="card shadow mb-0 h-30">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Atasan Pegawai</h6>
        </div>   
        <div class="card-body">
          <select name="atasan_id" class="chosen-select form-control">
            @foreach($pegawai as $p)
            <option value="{{$p->id}}">{{$p->nama_pegawai}}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="card shadow mb-0 h-75">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Jenis Cuti</h6>
        </div>   
        <div class="card-body">
          @foreach($jeniscuti as $jc)
          <div class="form-check">
            <input class="form-check-input" type="radio" name="jenis_cuti" id="{{$jc->jenis_cuti}}" value="{{$jc->jenis_cuti}}">
            <label class="form-check-label" for="{{$jc->jenis_cuti}}">
              {{$jc->ket}}
            </label>
          </div>
          @endforeach
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-lg-3">  
      <div class="card shadow mb-0 h-50">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Resume</h6>
        </div>
        <div class="card-body">
          Sisa Cuti Tahun Ini  :  8 hari
          <br>
          Sisa Cuti Tahun Lalu : 9 hari
        </div>
      </div>
      <div class="card shadow mb-0 h-50">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Action</h6>
        </div>
        <div class="card-body py-5 text-center">
          <button type="submit" class="btn btn-success">Simpan</button>
          <button type="reset" class="btn btn-primary">Reset</button>
        </div>
      </div>
    </div>
  </div>
</form>
@endsection

@section('script')
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

  <script src="{{url('vendors/chosen/chosen.jquery.js')}}"></script>
  <script src="{{url('vendors/chosen/chosen.proto.js')}}"></script>
  <script src="{{url('asset/js/jquery-ui.js')}}"></script>
  <script type="text/javascript">
  $(document).ready(function() {
    $( ".datepicker" ).datepicker({
          dateFormat: "dd MM yy"
    });

    $(".chosen-select").chosen();

    $(".custom-file-input").on('change', function(){
        let fileName= $(this).val().split('\\').pop();
        $(this).next(".custom-file-label").addClass("selected").html(fileName);
      });
  });
  </script>
@endsection