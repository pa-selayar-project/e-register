@extends('layouts.app')

@section('title','Edit Surat Tugas')

@section('stylesheet')
<link rel="stylesheet" href="{{url('vendors/chosen/chosen.css')}}">
<link rel="stylesheet" href="{{url('asset/css/jquery-UI.css')}}">
@endsection

@section('content')
<form action="/register/surat_tugas/{{$data->id}}" method="POST" enctype="multipart/form-data">
@method('patch')
@csrf
  <div class="col-xs-6 col-md-6">
    <div class="card">
      <div class="card-body card-block">
        <div class="form-group">
          <label class="form-control-label">
            <strong>Nomor Surat</strong>
          </label>
          <div class="input-group">
            <input type="text" name="no_stugas" class="form-control form-control-sm" value="{{$data->no_stugas}}">
          </div>
        </div>
        
        <div class="row m-auto d-flex">  
          <div class="form-group flex-fill mr-2">
            <label class="form-control-label">
              <strong>Tanggal</strong>
            </label>
            <div class="input-group">
              <input type="text" name="tgl_stugas" class="datepicker form-control form-control-sm" value="{{date('d F Y',$data->tgl_stugas)}}">
            </div>
          </div>

          <div class="form-group flex-fill">
            <label class="form-control-label">
              <strong>Penandatangan</strong>
            </label>
            <div class="input-group">
              <select name="ttd_stugas" class="chosen-select form-control">
                @foreach($penandatangan as $ttd)
                  <option value="{{$ttd->nama_pegawai}}" @if($ttd->nama_pegawai == $data->ttd_stugas)selected @endif>
                  {{$ttd->nama_pegawai}}
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
            <select name="pegawai[]" class="chosen-select form-control" multiple="multiple">
              @foreach($pelaksana as $p)
                <option value="{{$p->id}}" @if(in_array($p->id, explode(',',$data->pegawai))) selected @endif>
                  {{$p->nama_pegawai}}
                </option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="form-group">
          <label class="form-control-label">
            <strong>Pertimbangan</strong>
          </label>
          <div class="input-group">
            <textarea name="menimbang" rows="4" class="form-control">{{$data->menimbang}}</textarea>
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
            <textarea name="dasar" rows="2" class="form-control">{{$data->dasar}}</textarea>
          </div>
        </div>

        <div class="form-group">
          <label class="form-control-label">
            <strong>Maksud</strong>
          </label>
          <div class="input-group">
            <textarea name="maksud" rows="2" class="form-control">{{$data->maksud}}</textarea>
          </div>
        </div>
       
        <div class="form-group">
          <label class="form-control-label">
            <strong>DIPA</strong>
          </label>
          <div class="input-group">
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" id="dipa1" name="dipa" class="custom-control-input" value="1" @if($data->dipa == 1)checked @endif>
              <label class="custom-control-label" for="dipa1">Ya</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" id="dipa2" name="dipa" class="custom-control-input" value="2" @if($data->dipa == 2)checked @endif>
              <label class="custom-control-label" for="dipa2">Tidak</label>
            </div>
          </div>
        </div>

        <div class="row my-1">
          <div class="col col-md-1">
            <i class="fas fa-file-word @if($data->word)text-primary @else text-secondary @endif fa-2x ml-3"></i>
          </div>
          <div class="col col-md-5">
            <div class="custom-file">
              <input type="file" name="word" class="custom-file-input" id="word">
              <label class="custom-file-label" for="word">Choose file</label>
            </div>
             <small class="form-text text-danger">@error('word'){{$message}}@enderror</small>
          </div>  
          <div class="col col-md-1">
            <i class="fas fa-file-pdf @if($data->pdf)text-danger @else text-secondary @endif fa-2x ml-3"></i>
          </div>
          <div class="col col-md-5">
            <div class="custom-file">
              <input type="file" name="pdf" class="custom-file-input" id="pdf">
              <label class="custom-file-label" for="pdf">Choose file</label>
            </div>
             <small class="form-text text-danger">@error('pdf'){{$message}}@enderror</small>
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
  <script src="{{url('asset/js/jquery-UI.js')}}"></script>
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