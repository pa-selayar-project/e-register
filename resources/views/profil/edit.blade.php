@extends('layouts.app')

@section('title','Edit User')

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
    <form method="post" action="/profil/{{$data->id}}" enctype="multipart/form-data">
    @method("patch")
    @csrf
    <div class="col-lg-6 col-md-6">
      <div class="card">
        <div class="card-header">
          <strong class="card-title mb-3">Profile Card</strong>
        </div>
        <div class="card-body">
          <div class="mx-auto d-block">
            <img class="rounded-circle mx-auto d-block mb-3" src="/assets/pic/{{$data->image}}" height="250" width="250">
            <div class="custom-file">
              <input type="file" name="image" class="custom-file-input" id="image">
              <label class="custom-file-label" for="image">Choose file</label>
            </div>
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
        <div class="card-body mt-5">
          <div class="form-group row mt-5">
            <label for="name" class="col-sm-3 col-form-label">Username</label>
            <div class="col-sm-9">
              <div class="input-group">
                <input type="text" id="name" name="name" class="form-control" value="{{$data->name}}">
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label for="email" class="col-sm-3 col-form-label">Email</label>
            <div class="col-sm-9">
              <div class="input-group">
                <input type="email" id="email" name="email" class="form-control" value="{{$data->email}}">
              </div>
            </div>
          </div>
          <div class="form-group row">
            <div class="card-body py-5 text-center">
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
  $(".custom-file-input").on('change', function(){
    let fileName= $(this).val().split('\\').pop();
    $(this).next(".custom-file-label").addClass("selected").html(fileName);
  });
});
</script>
@endsection