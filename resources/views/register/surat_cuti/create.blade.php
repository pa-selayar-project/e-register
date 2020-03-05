@extends('layouts.app')

@section('title','Register Surat Cuti')

@section('stylesheet')
<link href="{{url('assets/css/css_datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css">
@endsection

@section('content')
<form method="post" action="">
<div class="row">
    <div class="col-xl-6 col-lg-6">  
      <div class="card shadow mb-4 h-100">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Data Surat Cuti</h6>
        </div>   
        <div class="card-body">
          <div class="form-group row">
            <label for="no_cuti" class="col-sm-3 col-form-label">Nomor</label>
            <div class="col-sm-9">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon3">W20-A17/</span>
                </div>
                <input type="number" name="no_cuti" id="no_cuti" min="0" class="form-control" value="{{old('no_cuti')}}" aria-describedby="basic-addon3"/>
                <div class="input-group-append">
                  <span class="input-group-text">/KP.02.1/XII/{{date('Y')}}</span>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label for="tgl_cuti" class="col-sm-3 col-form-label">Tanggal</label>
            <div class="col-sm-9">
              <div class="input-group date">
                <input type="text" id="tgl_cuti" name="tgl_cuti" class="form-control">
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
                <input type="text" id="mulai" name="mulai" class="form-control"> 
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon3">s/d</span>
                  </div> 
                <input type="text" id="akhir" name="akhir" class="form-control">
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label for="tgl_sc" class="col-sm-3 col-form-label">Alamat Cuti</label>
            <div class="col-sm-9">
              <textarea class="form-control" rows="3"></textarea>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-lg-3">  
      <div class="card shadow mb-0 h-auto">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Pegawai</h6>
        </div>   
        <div class="card-body">
          <select name="pegawai_id" class="form-control">
            <option value="1">Abdul Rahman Salam, S.Ag.,M.H.</option>
          </select>
        </div>
      </div>
      <div class="card shadow mb-0 h-auto">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Atasan Pegawai</h6>
        </div>   
        <div class="card-body">
          <select name="atasan_id" class="form-control">
            <option value="1">Abdul Rahman Salam, S.Ag.,M.H.</option>
          </select>
        </div>
      </div>
      <div class="card shadow mb-0 h-auto">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Jenis Cuti</h6>
        </div>   
        <div class="card-body">
          <select class="form-control">
            <option value="1">Abdul Rahman Salam, S.Ag.,M.H.</option>
          </select>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-lg-3">  
      <div class="card shadow mb-0 h-50">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Resume</h6>
        </div>
        <div class="card-body">
          Sisa Cuti  :  8 hari
          <br>
          Sisa Cuti Tahun Lalu : 9 hari
        </div>
      </div>
      <div class="card shadow mb-4 h-50">
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
<script src="{{url('assets/js/datepicker/bootstrap-datepicker.min.js')}}"></script>
<script type="text/javascript">
$(document).ready(function() {
  $('#tgl_cuti').datepicker({
      format: "dd/mm/yyyy",
      language: "id",
      autoclose: true,
      todayHighlight: true
  });
  $('#mulai').datepicker({
      format: "dd/mm/yyyy",
      language: "id",
      autoclose: true,
      todayHighlight: true
  })
  $('#akhir').datepicker({
      format: "dd/mm/yyyy",
      language: "id",
      autoclose: true,
      todayHighlight: true
  })
});
</script>
@endsection