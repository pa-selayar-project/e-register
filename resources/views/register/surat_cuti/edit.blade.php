@extends('layouts.app')

@section('title','Edit Surat Cuti')

@section('tombol')
  {!!$back!!}
@endsection


@section('stylesheet')
<link rel="stylesheet" href="{{url('vendors/chosen/chosen.css')}}">
<link rel="stylesheet" href="{{url('asset/css/jquery-ui.css')}}">
@endsection

@section('content')
<form method="post" action="/register/surat_cuti/{{$data->id}}" enctype="multipart/form-data">
@method("patch")
@csrf
<div class="row">
  <div class="col-xl-6 col-lg-6">  
    <div class="card shadow mb-4 h-100">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Data Surat Cuti</h6>
      </div>   
      <div class="card-body">
        <div class="form-group row">
          <label for="no_cuti" class="col-sm-3 col-form-label">Nama Pegawai</label>
          <div class="col-sm-9">
            <div class="input-group">
              <select name="pegawai_id" class="chosen-select form-control">
                @foreach($pegawai as $p)
                  <option value="{{$p->id}}" @if($p->id == $data->pegawai_id) selected @endif>{{$p->nama_pegawai}}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="no_cuti" class="col-sm-3 col-form-label">Nomor Surat</label>
          <div class="col-sm-9">
            <div class="input-group">
              <input type="text" id="no_cuti" name="no_cuti" class="form-control form-control-sm @error('no_cuti') is-invalid @enderror" value="{{$data->no_cuti}}">
              @error('no_cuti')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
              @enderror
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="tgl_cuti" class="col-sm-3 col-form-label">Tanggal</label>
          <div class="col-sm-9">
            <div class="input-group date">
              <input type="text" id="tgl_cuti" name="tgl_cuti" class="datepicker form-control form-control-sm @error('tgl_cuti') is-invalid @enderror" value="{{date('d M Y', $data->tgl_cuti)}}" autocomplete="off">
              <div class="input-group-append">
                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
              </div>
              @error('tgl_cuti')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
              @enderror
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="mulai" class="col-sm-3 col-form-label">Tanggal Cuti</label>
          <div class="col-sm-9">
            <div class="input-group date">
              <input type="text" id="mulai" name="mulai" class="datepicker form-control form-control-sm @error('mulai') is-invalid @enderror" value="{{date('d M Y', $data->mulai)}}" autocomplete="off"> 
              <div class="input-group-prepend">
                <span class="input-group-text form-control form-control-sm" id="basic-addon3">s/d</span>
              </div> 
              <input type="text" id="akhir" name="akhir" class="datepicker form-control form-control-sm @error('akhir') is-invalid @enderror" value="{{date('d M Y', $data->akhir)}}" autocomplete="off">
              @error('mulai')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
              @enderror
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="tgl_sc" class="col-sm-3 col-form-label">Alamat Cuti</label>
          <div class="col-sm-9">
            <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="2">{{$data->alamat}}</textarea>
            @error('alamat')
              <div class="invalid-feedback">
                {{$message}}
              </div>
            @enderror
          </div>
        </div>
        <div class="form-group row">
          <label for="alasan" class="col-sm-3 col-form-label">Alasan Cuti</label>
          <div class="col-sm-9">
            <textarea name="alasan" id="alasan" class="form-control @error('alasan') is-invalid @enderror" rows="2">{{$data->alasan}}</textarea>
            @error('alasan')
              <div class="invalid-feedback">
                {{$message}}
              </div>
            @enderror
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-lg-3">  
    <div class="card shadow mb-0 h-30">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Atasan Pegawai</h6>
      </div>   
      <div class="card-body">
        <select name="atasan_id" class="chosen-select form-control">
          @foreach($pegawai as $ap)
            <option value="{{$ap->id}}" @if($ap->id == $data->atasan_id) selected @endif>{{$ap->nama_pegawai}}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="card shadow mb-0 h-75">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Jenis Cuti</h6>
      </div>   
      <div class="card-body">
        @foreach($jeniscuti as $jc)
          <div class="form-check">
            <input class="form-check-input" type="radio" name="jenis_cuti" id="{{$jc->jenis_cuti}}" value="{{$jc->jenis_cuti}}" @if($jc->jenis_cuti == $data->jenis_cuti) checked @endif>
            <label class="form-check-label" for="{{$jc->jenis_cuti}}">{{$jc->ket}}</label>
          </div>
        @endforeach
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-lg-3">  
    <div class="card shadow mb-0 h-50">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Upload File</h6>
      </div>
      <div class="card-body">
        <div class="row my-3">
          <div class="col col-md-2">
            <i class="fas fa-file-word @if($data->word)text-primary @else text-secondary @endif fa-2x ml-3"></i>
          </div>
          <div class="col col-md-10">
            <div class="custom-file">
              <input type="file" name="word" class="custom-file-input @error('word') is-invalid @enderror" id="word">
              <label class="custom-file-label" for="word">Choose file</label>
              @error('word')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
              @enderror
            </div>
          </div>  
        </div>
        <div class="row">
          <div class="col col-md-2">
            <i class="fas fa-file-pdf @if($data->pdf)text-danger @else text-secondary @endif fa-2x ml-3"></i>
          </div>
          <div class="col col-md-10">
            <div class="custom-file">
              <input type="file" name="pdf" class="custom-file-input @error('pdf') is-invalid @enderror" id="pdf">
              <label class="custom-file-label" for="pdf">Choose file</label>
              @error('pdf')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
              @enderror
            </div>
          </div>  
        </div>
      </div>
    </div>
    <div class="card shadow mb-0 h-50">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Action</h6>
      </div>
      <div class="card-body py-5 text-center">
        <button type="submit" class="btn btn-success">Simpan</button>
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

    $(".custom-file-input").on('change', function(){
        let fileName= $(this).val().split('\\').pop();
        $(this).next(".custom-file-label").addClass("selected").html(fileName);
      });
  });
  </script>
@endsection