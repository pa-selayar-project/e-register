@extends('layouts.app')

@section('title','Edit Pramubhakti')

@section('content')
<div class="row">
  <div class="col-xl-12 col-lg-12">  
    <div class="card shadow mb-4 h-100">
      <div class="card-body mt-5">
        <form method="POST" action="/settings/pramubhakti/{{$data->id}}" enctype="multipart/form-data">
          @method("patch")
          @csrf
          <div class="row">
            <div class="col-md-3">
              @if($data->foto)
              <img class="image img-profile mb-1" src="/assets/pic/{{$data->foto}}" width="265px" height="300px"/>
              @else
              <img class="img-rounded" src="/assets/pic/user.png" width="100%" height="100%"/>
              @endif
              <div class="custom-file">
                <input type="file" name="foto" class="custom-file-input" id="foto">
                <label class="custom-file-label" for="foto">Choose file</label>
              </div>
            </div>
            <div class="col-md-9">
              <div class="form-group row">
                <label for="nama_pegawai" class="col-sm-3 col-form-label">Nama Lengkap</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="nama_pegawai" id="nama_pegawai" value="{{$data->nama_pegawai}}">
                  <small class="form-text text-danger">@error('nama_pegawai'){{$message}}@enderror</small>
                </div>
              </div>
              <div class="form-group row">
                <label for="nama_pegawai" class="col-sm-3 col-form-label">Tempat Lahir</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" value="{{$data->tempat_lahir}}">
                  <small class="form-text text-danger">@error('tempat_lahir'){{$message}}@enderror</small>
                </div>
              </div>
              <div class="form-group row">
                <label for="jabatan" class="col-sm-3 col-form-label">Jabatan</label>
                <div class="col-sm-9">
                  <select name="jabatan_id" id="jabatan_id" class="form-control">
                  @foreach($jabatan as $j)
                    <option value="{{$j->id}}" @if($j->id==$data->jabatan_id)selected @endif>{{$j->nama_jabatan}}</option>
                  @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                <div class="col-sm-9">
                  <textarea rows="2" class="form-control" name="alamat" id="alamat">{{$data->alamat}}</textarea>
                </div>
              </div>  
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-12">
              <button type="submit" class="btn btn-success float-right ml-2">Simpan</button>
              <button type="reset" class="btn btn-secondary float-right">Reset</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<script>
$(document).ready(function () {
  $(".custom-file-input").on('change', function(){
    let fileName= $(this).val().split('\\').pop();
    $(this).next(".custom-file-label").addClass("selected").html(fileName);
  });
});
</script>
@endsection
