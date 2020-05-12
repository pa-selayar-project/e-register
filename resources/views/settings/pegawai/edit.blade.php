@extends('layouts.app')

@section('title','Edit Pegawai')

@section('content')
<div class="row">
  <div class="col-xl-12 col-lg-12">  
    <div class="card shadow mb-4 h-100">
      <div class="card-body mt-5">
        <form method="POST" action="/settings/pegawai/{{$pegawai->id}}" enctype="multipart/form-data">
          @method("patch")
          @csrf
          <div class="row">
            <div class="col-md-3">
              @if($pegawai->foto)
              <img class="image img-profile mb-1" src="/assets/pic/{{$pegawai->foto}}" width="265px" height="300px"/>
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
                  <input type="text" class="form-control" name="nama_pegawai" id="nama_pegawai" value="{{$pegawai->nama_pegawai}}">
                  <small class="form-text text-danger">@error('nama_pegawai'){{$message}}@enderror</small>
                </div>
              </div>
              <div class="form-group row">
                <label for="nama_pegawai" class="col-sm-3 col-form-label">Tempat Lahir</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" value="{{$pegawai->tempat_lahir}}">
                  <small class="form-text text-danger">@error('tempat_lahir'){{$message}}@enderror</small>
                </div>
              </div>
              <div class="form-group row">
                <label for="name" class="col-sm-3 col-form-label">NIP</label>
                <div class="col-sm-9">
                  <input type="number" min="195001011970011000" class="form-control" id="nip" name="nip" value="{{$pegawai->nip}}">
                  <small class="form-text text-danger">@error('nip'){{$message}}@enderror</small>
                </div>
              </div>
              <div class="form-group row">
                <label for="name" class="col-sm-3 col-form-label">Pangkat/Jabatan</label>
                <div class="col-sm-5">
                  <select name="pangkat_id" id="pangkat_id" class="form-control">
                    @foreach($pangkat as $pgkt)
                      <option value="{{$pgkt->id}}" @if($pgkt->id==$pegawai->pangkat_id)selected @endif>{{$pgkt->nama_pangkat}} ({{$pgkt->golongan}})</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-sm-4">
                  <select name="jabatan" id="jabatan" class="form-control">
                    @foreach($jabatan as $jbt)
                      <option value="{{$jbt->nama_jabatan}}" @if($jbt->nama_jabatan==$pegawai->jabatan)selected @endif>{{$jbt->nama_jabatan}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                <div class="col-sm-9">
                  <textarea rows="2" class="form-control" name="alamat" id="alamat">{{$pegawai->alamat}}</textarea>
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
