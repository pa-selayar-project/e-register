@extends('layouts.app')

@section('title','Ubah Password')

@section('breadcumb')
<a href="javascript:history.back();" class="d-none d-sm-inline-block btn btn-sm btn-primary btn-icon-split rounded mr-1">
  <span class="icon text-white-50">
    <i class="fa fa-chevron-circle-left"></i>
  </span>
</a>
@endsection

@section('content')
<div class="card shadow mb-4">
  <div class="card-body">
    <form method="post" action="/profil/update_password/{{$data->id}}">
    @method("patch")
    @csrf
    <div class="col-lg-6 col-md-6">
      <div class="card">
        <div class="card-header">
          <strong class="card-title mb-3">Profil</strong>
        </div>
        <div class="card-body">
          <div class="mx-auto d-block">
            <img class="rounded-circle mx-auto d-block mb-3" src="/assets/pic/{{$data->image}}" height="250" width="250">
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
          <div class="form-group row mt-5">
            <label for="password_lama" class="col-sm-3 col-form-label">Password Lama</label>
            <div class="col-sm-9">
              <div class="input-group">
                <input type="password" id="password_lama" name="password_lama" class="form-control">
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label for="password" class="col-sm-3 col-form-label">Password Baru</label>
            <div class="col-sm-9">
              <div class="input-group">
                <input type="password" id="password" name="password" class="form-control">
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label for="ulang_password" class="col-sm-3 col-form-label">Ulang Password</label>
            <div class="col-sm-9">
              <div class="input-group">
                <input type="password" id="ulang_password" name="ulang_password" class="form-control">
              </div>
            </div>
          </div>
          <div class="form-group row">
            <div class="card-body text-center">
              <button type="submit" class="btn btn-success">Update</button>
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
  $(".custom-file-input").on('change', function(){
    let fileName= $(this).val().split('\\').pop();
    $(this).next(".custom-file-label").addClass("selected").html(fileName);
  });
});
</script>
@endsection