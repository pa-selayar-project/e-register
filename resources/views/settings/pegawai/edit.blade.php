@extends('layouts.app')

@section('title','Edit Pegawai')

@section('breadcumb')
<a href="#" onclick="javascript:history.back();" class="ml-1 d-none d-sm-inline-block btn btn-sm btn-danger">
  <span class="icon text-white">
    <i class="fas fa-arrow-alt-circle-left"></i>
  </span>
</a>
@endsection

@section('stylesheet')
<link rel="stylesheet" href="{{url('vendors/chosen/chosen.css')}}">
<link rel="stylesheet" href="{{url('asset/css/jquery-ui.css')}}">
@endsection

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
              <img class="image img-profile mb-1" src="/assets/pic/{{$pegawai->foto}}" width="265px" height="300px" />
              @else
              <img class="img-rounded" src="/assets/pic/user.png" width="100%" height="100%" />
              @endif
              <div class="custom-file">
                <input type="file" name="foto" class="custom-file-input" id="foto">
                <label class="custom-file-label" for="foto">Choose file</label>
              </div>
            </div>
            <div class="col-md-9">
              <div class="form-group row">
                <label for="nama_pegawai" class="col-sm-3 col-form-label">Nama Lengkap / TTL</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="nama_pegawai" id="nama_pegawai" value="{{$pegawai->nama_pegawai}}">
                </div>
                <div class="col-sm-4">
                  <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" value="{{$pegawai->tempat_lahir}}">
                  <small class="form-text text-danger">@error('tempat_lahir'){{$message}}@enderror</small>
                </div>
              </div>

              <div class="form-group row">
                <label for="nip" class="col-sm-3 col-form-label">NIP</label>
                <div class="col-sm-9">
                  <input type="number" min="195001011970011000" class="form-control" id="nip" name="nip" value="{{$pegawai->nip}}">
                  <small class="form-text text-danger">@error('nip'){{$message}}@enderror</small>
                </div>
              </div>

              <div class="form-group row">
                <label for="name" class="col-sm-3 col-form-label">Pangkat/Jabatan</label>
                <div class="col-sm-5">
                  <select name="pangkat_id" id="pangkat_id" class="form-control chosen-select">
                    @foreach($pangkat as $pgkt)
                    <option value="{{$pgkt->id}}" @if($pgkt->id==$pegawai->pangkat_id)selected @endif>{{$pgkt->nama_pangkat}} ({{$pgkt->golongan}})</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-sm-4">
                  <select name="jabatan_id" id="jabatan_id" class="form-control chosen-select">
                    @foreach($jabatan as $jbt)
                    <option value="{{$jbt->id}}" @if($jbt->id==$pegawai->jabatan_id)selected @endif>{{$jbt->nama_jabatan}}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <label for="name" class="col-sm-3 col-form-label">KGB / KP YAD / Sisa Cuti</label>
                <div class="col-sm-3">
                  <input type="text" name="kgb_yad" id="kgb_yad" class="datepicker form-control" value="{{date('d F Y', $pegawai->kgb_yad)}}">
                </div>
                <div class="col-sm-3">
                  <input type="text" name="kp_yad" id="kp_yad" class="datepicker form-control" value="{{date('d F Y', $pegawai->kp_yad)}}">
                </div>
                <div class="col-sm-3">
                  <input type="number" name="sisa_cuti" id="sisa_cuti" class="form-control" min="0" max="12" value="{{$pegawai->sisa_cuti}}">
                </div>
              </div>

              <div class="form-group row">
                <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                <div class="col-sm-9">
                  <textarea rows="2" class="form-control" name="alamat" id="alamat">{{$pegawai->alamat}}</textarea>
                </div>
              </div>

              <div class="form-group row">
                <label for="nama_pegawai" class="col-sm-3 col-form-label">Aktif</label>
                <div class="col-sm-9">
                  <label class="switch switch-3d switch-success mr-3"><input type="checkbox" name="aktif" class="switch-input" value="1" @if($pegawai->aktif==1) checked @endif> <span class="switch-label"></span> <span class="switch-handle"></span></label>
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

<script src="{{url('vendors/chosen/chosen.jquery.js')}}"></script>
<script src="{{url('vendors/chosen/chosen.proto.js')}}"></script>
<script src="{{url('asset/js/jquery-ui.js')}}"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $(".datepicker").datepicker({
      dateFormat: "dd MM yy"
    });

    $(".chosen-select").chosen();

    $(".custom-file-input").on('change', function() {
      let fileName = $(this).val().split('\\').pop();
      $(this).next(".custom-file-label").addClass("selected").html(fileName);
    });
  });
</script>
@endsection