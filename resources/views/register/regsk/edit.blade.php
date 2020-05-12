@extends('layouts.app')

@section('title','Edit SK')

@section('stylesheet')
<link rel="stylesheet" href="{{url('vendors/chosen/chosen.css')}}">
<link rel="stylesheet" href="{{url('asset/css/jquery-UI.css')}}">
@endsection

@section('content')
<?php $obyek = explode(',', $regsk->obyek);?>
<?php if($regsk->obyek!=""){$obyek;}?>

<form action="/register/regsk/{{$regsk->id}}" method="POST" enctype="multipart/form-data">
@method("patch")
@csrf
  <div class="col-xs-6 col-md-6">
    <div class="card">
      <div class="card-body card-block">
        
        <div class="form-group">
          <label class="form-control-label">
            <strong>Nomor SK</strong>
          </label>
          
          <div class="input-group">
            <input type="text" name="no_sk" class="form-control form-control-sm" value="{{$regsk->no_sk}}">
          </div>
          <small class="form-text text-danger">@error('no_sk'){{$message}}@enderror</small>
        </div>
        
        <div class="row m-auto d-flex">  
          <div class="form-group flex-fill mr-2">
            <label class="form-control-label">
              <strong>Tanggal</strong>
            </label>

            <div class="input-group">
              <input type="text" name="tgl_sk" class="datepicker form-control form-control-sm" value="{{date('d F yy', $regsk->tgl_sk)}}">
            </div>
            <small class="form-text text-danger">@error('tgl_sk'){{$message}}@enderror</small>
          </div>

          <div class="form-group flex-fill">
            <label class="form-control-label">
              <strong>Bidang SK</strong>
            </label>

            <div class="input-group">
              <select name="bidang_sk" class="chosen-select form-control form-control-lg">
                <option value="Kepaniteraan" @if($regsk->bidang_sk == "Kepaniteraan") selected @endif>Kepaniteraan</option>
                <option value="Sekretariat" @if($regsk->bidang_sk == "Sekretariat") selected @endif>Sekretariat</option>
              </select>
            </div>
          </div>
        </div>  

        <div class="form-group">
          <label class="form-control-label">
            <strong>Nama SK</strong>
          </label>

          <div class="input-group">
            <input type="text" name="nama_sk" class="form-control form-control-sm" value="{{$regsk->nama_sk}}">
          </div>
          <small class="form-text text-danger">@error('nama_sk'){{$message}}@enderror</small>
        </div>

        <div class="form-group">
          <label class="form-control-label">
            <strong>Deskripsi</strong>
          </label>

          <div class="input-group">
            <textarea name="desc_sk" rows="4" class="form-control">{{$regsk->desc_sk}}</textarea>
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
            <strong>Obyek SK</strong>
          </label>

          <div class="input-group">
            <select name="obyek[]" class="chosen-select form-control form-control-lg" multiple="multiple">
        
              @foreach($pegawai as $p)
              <option value="{{$p->id}}" @if(in_array($p->id, $obyek)) selected @endif>{{$p->nama_pegawai}}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="form-group">
          <label class="form-control-label">
            <strong>Penandatangan SK</strong>
          </label>

          <div class="input-group">
            <select name="ttd_sk" class="chosen-select form-control form-control-lg">
              <option value="Ketua" @if($regsk->ttd_sk == "Ketua") selected @endif >Ketua</option>
              <option value="Panitera" @if($regsk->ttd_sk == "Panitera") selected @endif>Panitera</option>
              <option value="Sekretaris" @if($regsk->ttd_sk == "Sekretaris") selected @endif>Sekretaris</option>
            </select>
          </div>
        </div>

        <label class="form-control-label">
          <strong>Files</strong>
        </label>

        <div class="row my-3">
          <div class="col col-md-2">
            <i class="fas fa-file-word @if($regsk->pdf)text-primary @else text-secondary @endif fa-3x ml-3"></i>
          </div>
          <div class="col col-md-10">
            <div class="custom-file">
              <input type="file" name="word" class="custom-file-input" id="word">
              <label class="custom-file-label" for="word">Choose file</label>
            </div>
             <small class="form-text text-danger">@error('word'){{$message}}@enderror</small>
          </div>  
        </div>
        <div class="row">
          <div class="col col-md-2">
            <i class="fas fa-file-pdf @if($regsk->pdf)text-danger @else text-secondary @endif fa-3x ml-3"></i>
          </div>
          <div class="col col-md-10">
            <div class="custom-file">
              <input type="file" name="pdf" class="custom-file-input" id="pdf">
              <label class="custom-file-label" for="pdf">Choose file</label>
            </div>
             <small class="form-text text-danger">@error('pdf'){{$message}}@enderror</small>
          </div>  
        </div>

        <div class="form-group my-4 float-right">
          <button type="submit" class="btn btn-primary">Submit</button>
          <button type="reset" class="btn btn-secondary">Reset</button>
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