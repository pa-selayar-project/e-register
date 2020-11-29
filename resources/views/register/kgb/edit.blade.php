@extends('layouts.app')

@section('title','Edit KGB')

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
<form method="post" action="/register/kgb/{{$data->id}}" enctype="multipart/form-data">
  @csrf
  @method("patch")
  <div class="row">
    <div class="col-xl-6 col-lg-6">
      <div class="card shadow mb-4 h-100">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Data Surat KGB ({{$data->pegawai->nama_pegawai}})</h6>
          <input type="hidden" name="pegawai_id" value="{{$data->pegawai->id}}">
        </div>
        <div class="card-body">
          <div class="form-group row">
            <label for="pegawai_id" class="col-sm-4 col-form-label">Nomor Surat KGB</label>
            <div class="col-sm-8">
              <div class="input-group">
                <input type="text" id="no_kgb" name="no_kgb" class="form-control" value="{{$data->no_kgb}}">
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label for="tgl_kgb" class="col-sm-4 col-form-label">Tanggal</label>
            <div class="col-sm-8">
              <div class="input-group date">
                <input type="text" id="tgl_kgb" name="tgl_kgb" class="datepicker form-control" value="{{date('d F Y',$data->tgl_kgb)}}">
                <div class="input-group-append">
                  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label for="gapok_baru" class="col-sm-4 col-form-label">Gaji Pokok</label>
            <div class="col-sm-8">
              <div class="input-group">
                <input type="number" id="gapok_baru" name="gapok_baru" class="form-control" min="0" value="{{$data->gapok_baru}}">
              </div>
            </div>
          </div>

          <div class="form-group row">
            <label for="masa_kerja" class="col-sm-4 col-form-label">Masa Kerja Golongan</label>
            <div class="col-sm-8">
              <div class="input-group">
                <input type="text" id="masa_kerja" name="masa_kerja" class="form-control" value="{{$data->masa_kerja}}">
              </div>
            </div>
          </div>

          <div class="form-group row">
            <label for="tmt_kgb" class="col-sm-4 col-form-label">TMT KGB</label>
            <div class="col-sm-8">
              <div class="input-group date">
                <input type="text" id="tmt_kgb" name="tmt_kgb" class="datepicker form-control" value="{{date('d F Y', $data->tmt_kgb)}}" autocomplete="off">
                <div class="input-group-append">
                  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                </div>
              </div>
            </div>
          </div>

          <div class="form group row mb-1">
            <div class="col col-md-4">
              <i class="fas fa-file-word @if($data->word)text-primary @else text-secondary @endif fa-3x ml-3"></i>
            </div>
            <div class="col col-md-8">
              <div class="custom-file">
                <input type="file" name="word" class="custom-file-input" id="word">
                <label class="custom-file-label" for="word">Choose file</label>
              </div>
              <small class="form-text text-danger">@error('word'){{$message}}@enderror</small>
            </div>
          </div>
          <div class="form group row">
            <div class="col col-md-4">
              <i class="fas fa-file-pdf @if($data->pdf)text-danger @else text-secondary @endif fa-3x ml-3"></i>
            </div>
            <div class="col col-md-8">
              <div class="custom-file">
                <input type="file" name="pdf" class="custom-file-input" id="pdf">
                <label class="custom-file-label" for="pdf">Choose file</label>
              </div>
              <small class="form-text text-danger">@error('pdf'){{$message}}@enderror</small>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="col-xl-6 col-lg-6">
      <div class="card shadow mb-4 h-100">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Data KGB Lama</h6>
        </div>
        <div class="card-body">
          <div class="form-group row">
            <label for="kgb_lama" class="col-sm-4 col-form-label">Nomor KGB/SK</label>
            <div class="col-sm-8">
              <div class="input-group">
                <input type="text" id="kgb_lama" name="kgb_lama" class="form-control" value="{{$data->kgb_lama}}">
              </div>
            </div>
          </div>

          <div class="form-group row">
            <label for="tgl_kgb_lama" class="col-sm-4 col-form-label">Tanggal KGB Lama</label>
            <div class="col-sm-8">
              <div class="input-group date">
                <input type="text" id="tgl_kgb_lama" name="tgl_kgb_lama" class="datepicker form-control" value="{{date('d F Y', $data->tgl_kgb_lama)}}">
                <div class="input-group-append">
                  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                </div>
              </div>
            </div>
          </div>

          <div class="form-group row">
            <label for="gapok_lama" class="col-sm-4 col-form-label">Gaji Pokok</label>
            <div class="col-sm-8">
              <div class="input-group">
                <input type="number" id="gapok_lama" name="gapok_lama" class="form-control" min="0" value="{{$data->gapok_lama}}">
              </div>
            </div>
          </div>

          <div class="form-group row">
            <label for="masa_kerja_lama" class="col-sm-4 col-form-label">Masa Kerja Lama</label>
            <div class="col-sm-8">
              <div class="input-group">
                <input type="text" id="masa_kerja_lama" name="masa_kerja_lama" class="form-control" value="{{$data->masa_kerja_lama}}">
              </div>
            </div>
          </div>

          <div class="form-group row">
            <label for="tmt_kgb_lama" class="col-sm-4 col-form-label">TMT KGB Lama</label>
            <div class="col-sm-8">
              <div class="input-group date">
                <input type="text" id="tmt_kgb_lama" name="tmt_kgb_lama" class="datepicker form-control" value="{{date('d F Y', $data->tmt_kgb_lama)}}" autocomplete="off">
                <div class="input-group-append">
                  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                </div>
              </div>
            </div>
          </div>

          <div class="form-group row">
            <label for="pejabat_kgb_lama" class="col-sm-4 col-form-label">Pejabat KGB Lama</label>
            <div class="col-sm-8">
              <div class="input-group date">
                <input type="text" id="pejabat_kgb_lama" name="pejabat_kgb_lama" class="form-control" value="{{$data->pejabat_kgb_lama}}">
              </div>
            </div>
          </div>

        </div>
        <div class="card-footer text-right">
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