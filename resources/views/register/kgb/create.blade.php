@extends('layouts.app')

@section('title','Rekam KGB')

@section('stylesheet')
<link rel="stylesheet" href="{{url('vendors/chosen/chosen.css')}}">
<link rel="stylesheet" href="{{url('asset/css/jquery-ui.css')}}">
@endsection

@section('breadcumb')
<a href="{{url('register/kgb')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary btn-icon-split rounded mr-1">
  <span class="icon text-white-50">
    <i class="fa fa-chevron-circle-left"></i>
  </span>
</a>
@endsection


@section('content')
<form method="post" action="{{url('register/kgb')}}">
@csrf
<div class="row">
  <div class="col-xl-6 col-lg-6">  
    <div class="card shadow mb-4 h-100">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Data Surat KGB</h6>
      </div>   
      <div class="card-body">
        <div class="form-group row">
          <label for="pegawai_id" class="col-sm-4 col-form-label">Nama Pegawai</label>
          <div class="col-sm-8">
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
          <label for="tgl_kgb" class="col-sm-4 col-form-label">Tanggal</label>
          <div class="col-sm-8">
            <div class="input-group date">
              <input type="text" id="tgl_kgb" name="tgl_kgb" class="datepicker form-control @error('tgl_kgb') is-invalid @enderror" autocomplete="off">
              <div class="input-group-append">
                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
              </div>
              @error('tgl_kgb')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
              @enderror
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="gapok_baru" class="col-sm-4 col-form-label">Gaji Pokok</label>
          <div class="col-sm-8">
            <div class="input-group">
              <input type="number" id="gapok_baru" name="gapok_baru" class="form-control @error('gapok_baru') is-invalid @enderror" min="0">
              @error('gapok_baru')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
              @enderror
            </div>
          </div>
        </div>
        
        <div class="form-group row">
          <label for="masa_kerja" class="col-sm-4 col-form-label">Masa Kerja Golongan</label>
          <div class="col-sm-8">
            <div class="input-group">
              <input type="text" id="masa_kerja" name="masa_kerja" class="form-control @error('masa_kerja') is-invalid @enderror">
              @error('masa_kerja')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
              @enderror
            </div>
          </div>
        </div>
        
        <div class="form-group row">
          <label for="tmt_kgb" class="col-sm-4 col-form-label">TMT KGB</label>
          <div class="col-sm-8">
            <div class="input-group date">
              <input type="text" id="tmt_kgb" name="tmt_kgb" class="datepicker form-control @error('tmt_kgb') is-invalid @enderror" autocomplete="off">
              <div class="input-group-append">
                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
              </div>
              @error('tmt_kgb')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
              @enderror
            </div>
          </div>
        </div>

        <div class="form-group row">
          <label for="pejabat_kgb" class="col-sm-4 col-form-label">Pejabat KGB</label>
          <div class="col-sm-8">
            <div class="input-group date">
              <input type="text" id="pejabat_kgb" name="pejabat_kgb" class="form-control" value="Ketua Pengadilan Agama Selayar" disabled>
            </div>
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
              <input type="text" id="kgb_lama" name="kgb_lama" class="form-control @error('kgb_lama') is-invalid @enderror">
              @error('kgb_lama')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
              @enderror
            </div>
          </div>
        </div>

        <div class="form-group row">
          <label for="tgl_kgb_lama" class="col-sm-4 col-form-label">Tanggal KGB Lama</label>
          <div class="col-sm-8">
            <div class="input-group date">
              <input type="text" id="tgl_kgb_lama" name="tgl_kgb_lama" class="datepicker form-control @error('tgl_kgb_lama') is-invalid @enderror" autocomplete="off">
              <div class="input-group-append">
                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
              </div>
              @error('tgl_kgb_lama')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
              @enderror
            </div>
          </div>
        </div>

        <div class="form-group row">
          <label for="gapok_lama" class="col-sm-4 col-form-label">Gaji Pokok</label>
          <div class="col-sm-8">
            <div class="input-group">
              <input type="number" id="gapok_lama" name="gapok_lama" class="form-control @error('gapok_lama') is-invalid @enderror" min="0">
              @error('gapok_lama')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
              @enderror
            </div>
          </div>
        </div>

        <div class="form-group row">
          <label for="masa_kerja_lama" class="col-sm-4 col-form-label">Masa Kerja Lama</label>
          <div class="col-sm-8">
            <div class="input-group">
              <input type="text" id="masa_kerja_lama" name="masa_kerja_lama" class="form-control @error('masa_kerja_lama') is-invalid @enderror">
              @error('masa_kerja_lama')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
              @enderror
            </div>
          </div>
        </div>

        <div class="form-group row">
          <label for="tmt_kgb_lama" class="col-sm-4 col-form-label">TMT KGB Lama</label>
          <div class="col-sm-8">
            <div class="input-group date">
              <input type="text" id="tmt_kgb_lama" name="tmt_kgb_lama" class="datepicker form-control @error('tmt_kgb_lama') is-invalid @enderror" autocomplete="off">
              <div class="input-group-append">
                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
              </div>
              @error('tmt_kgb_lama')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
              @enderror
            </div>
          </div>
        </div>

        <div class="form-group row">
          <label for="pejabat_kgb_lama" class="col-sm-4 col-form-label">Pejabat KGB Lama</label>
          <div class="col-sm-8">
            <div class="input-group date">
              <input type="text" id="pejabat_kgb_lama" name="pejabat_kgb_lama" class="form-control @error('pejabat_kgb_lama') is-invalid @enderror">
              @error('pejabat_kgb_lama')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
              @enderror
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
    $( ".datepicker" ).datepicker({
          dateFormat: "dd MM yy"
    });

    $(".chosen-select").chosen();

    $('select').on('change', function(){
      let id = $(this).val();
      
      $.ajax({
        type: 'GET',
        url:id+'/hasil',
        success:function(result){
          console.log(result);
          $('#masa_kerja').val(result[1]);
        }
      });
    });
  });
  </script>
@endsection