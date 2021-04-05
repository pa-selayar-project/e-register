@extends('layouts.app')

@section('title','Rekam Surat Tugas')

@section('stylesheet')
<link rel="stylesheet" href="{{url('vendors/chosen/chosen.css')}}">
<link rel="stylesheet" href="{{url('asset/css/jquery-ui.css')}}">
@endsection

@section('breadcumb')
<a href="{{url('register/surat_tugas')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary btn-icon-split rounded mr-1">
  <span class="icon text-white-50">
    <i class="fa fa-chevron-circle-left"></i>
  </span>
</a>
@endsection

@section('content')
<form action="/register/surat_tugas" method="POST">
@csrf
  <div class="col-xs-6 col-md-6">
    <div class="card">
      <div class="card-body card-block">
        <div class="form-group">
          <label class="form-control-label">
            <strong>Nomor Surat</strong>
          </label>
          <div class="input-group">
            <input type="text" name="no_stugas" class="form-control form-control-sm @error('no_stugas') is-invalid @enderror" value="{{old('no_stugas')}}">

            @error('no_stugas')
              <div class="invalid-feedback">
                {{$message}}
              </div>
            @enderror
          </div>
        </div>
        
        <div class="row m-auto d-flex">  
          <div class="form-group flex-fill mr-2">
            <label class="form-control-label">
              <strong>Tanggal</strong>
            </label>
            <div class="input-group">
              <input type="text" name="tgl_stugas" class="datepicker form-control form-control-sm @error('tgl_stugas') is-invalid @enderror" value="{{old('tgl_stugas')}}" autocomplete="off">
              
              @error('tgl_stugas')
              <div class="invalid-feedback">
                {{$message}}
              </div>
              @enderror
            </div>
          </div>

          <div class="form-group flex-fill">
            <label class="form-control-label">
              <strong>Penandatangan</strong>
            </label>
            <div class="input-group">
              <select name="ttd_stugas" class="chosen-select form-control">
                @foreach($penandatangan as $ttd)
                  <option value="{{$ttd->jabatan_id}}">
                  {{$ttd->jabatan->nama_jabatan}}
                  </option>
                @endforeach
              </select>
            </div>
          </div>
        </div>  

        <div class="form-group">
          <label class="form-control-label">
            <strong>Pelaksana</strong>
          </label>
          <div class="input-group">
            <select name="pegawai[]" class="chosen-select form-control @error('pegawai') is-invalid @enderror" multiple="multiple">
              @foreach($pelaksana as $p)
                <option value="{{$p->nip}}">
                  {{$p->nama_pegawai}}
                </option>
              @endforeach
            </select>
            
            @error('pegawai')
              <div class="invalid-feedback">
                {{$message}}
              </div>
            @enderror
          </div>
        </div>

        <div class="form-group">
          <label class="form-control-label">
            <strong>Pertimbangan</strong>
          </label>
          <div class="input-group">
            <textarea name="menimbang" rows="4" class="form-control @error('menimbang') is-invalid @enderror">{{old('menimbang')}}</textarea>
            @error('menimbang')
              <div class="invalid-feedback">
                {{$message}}
              </div>
            @enderror
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xs-6 col-sm-6">
    <div class="card">
      <div class="card-body">
        <div class="form-group">
          <label class="form-control-label">
            <strong>Dasar</strong>
          </label>
          <div class="input-group">
            <textarea name="dasar" rows="3" class="form-control @error('dasar') is-invalid @enderror">{{old('dasar')}}</textarea>
            @error('dasar')
              <div class="invalid-feedback">
                {{$message}}
              </div>
            @enderror
          </div>
        </div>

        <div class="form-group">
          <label class="form-control-label">
            <strong>Maksud</strong>
          </label>
          <div class="input-group">
            <textarea name="maksud" rows="3" class="form-control @error('maksud') is-invalid @enderror">{{old('maksud')}}</textarea>
            @error('maksud')
              <div class="invalid-feedback">
                {{$message}}
              </div>
            @enderror
          </div>
        </div>
       
        <div class="form-group">
          <label class="form-control-label">
            <strong>DIPA</strong>
          </label>
          <div class="input-group">
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" id="dipa1" name="dipa" class="custom-control-input" value="1" checked>
              <label class="custom-control-label" for="dipa1">Ya</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" id="dipa2" name="dipa" class="custom-control-input" value="2">
              <label class="custom-control-label" for="dipa2">Tidak</label>
            </div>
          </div>
        </div>

        <div class="form-group float-right">
          <button type="reset" class="btn btn-secondary">Reset</button>
          <button type="submit" class="btn btn-primary">Submit</button>
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
  <script>
    $(document).ready(function () {
      $(".chosen-select").chosen();

      $( ".datepicker" ).datepicker({
        dateFormat: "dd MM yy"
      });

      $(".custom-file-input").on('change', function(){
        let fileName= $(this).val().split('\\').pop();
        $(this).next(".custom-file-label").addClass("selected").html(fileName);
      });
    });
  </script>
@endsection