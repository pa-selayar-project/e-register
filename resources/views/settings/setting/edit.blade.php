@extends('layouts.app')

@section('title','Edit Setting Aplikasi')

@section('breadcumb')
<a href="{{url('settings/setting')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary btn-icon-split rounded mr-1">
  <span class="icon text-white-50">
    <i class="fa fa-chevron-circle-left"></i>
  </span>
</a>
@endsection

@section('content')
<div class="card shadow mb-4">
  <div class="card-body">
    <form method="post" action="/settings/setting/{{$data->id}}" enctype="multipart/form-data">
    @method("patch")
    @csrf
    <div class="col-lg-6 col-md-6">
      <div class="card">
        <div class="card-header">
          <strong class="card-title mb-3">Logo Aplikasi</strong>
        </div>
        <div class="card-body">
          <div class="mx-auto d-block">
            <img class="rounded-circle mx-auto d-block" src="/assets/images/logo/{{$data->logo_besar}}" height="250" width="250">
            <div class="custom-file">
              <input type="file" name="logo_besar" class="custom-file-input file1" id="logo_besar">
              <label class="custom-file-label" for="logo_besar">Choose file</label>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-6 col-md-6">
      <div class="card">
        <div class="card-header">
          <strong class="card-title">Resume Aplikasi</strong>
        </div>
        <div class="card-body">
          <div class="form-group row">
            <label for="nama_aplikasi" class="col-sm-3 col-form-label">Nama Aplikasi</label>
            <div class="col-sm-9">
              <div class="input-group">
                <input type="text" id="nama_aplikasi" name="nama_aplikasi" class="form-control" value="{{$data->nama_aplikasi}}">
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label for="versi" class="col-sm-3 col-form-label">Versi</label>
            <div class="col-sm-9">
              <div class="input-group">
                <input type="text" id="versi" name="versi" class="form-control" value="{{$data->versi}}">
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label for="author" class="col-sm-3 col-form-label">Author</label>
            <div class="col-sm-9">
              <div class="input-group">
                <input type="text" id="author" name="author" class="form-control" value="{{$data->author}}">
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label for="logo_kecil" class="col-sm-3 col-form-label2">Small Logo</label>
            <div class="col-sm-9">
              <div class="input-group">
                <input type="file" id="logo_kecil" name="logo_kecil" class="custom-file-input file2">
                <label class="custom-file-label" for="logo_kecil">Choose file</label>
              </div>
            </div>
          </div>
          <div class="form-group row">
            <div class="card-body text-center">
              <button type="submit" class="btn btn-success">Simpan</button>
              <button type="reset" class="btn btn-primary">Reset</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    </form>
  </div>
</div>
@endsection

@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
  $(".file1").on('change', function(){
    let fileName= $(this).val().split('\\').pop();
    $(this).next(".custom-file-label").addClass("selected").html(fileName);
  });

  $(".file2").on('change', function(){
    let fileName= $(this).val().split('\\').pop();
    $(this).next(".custom-file-label").addClass("selected").html(fileName);
  });
});
</script>
@endsection