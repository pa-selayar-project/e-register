@extends('layouts.app')

@section('title','Edit SOP')

@section('stylesheet')
<link rel="stylesheet" href="{{url('vendors/chosen/chosen.css')}}">
<link rel="stylesheet" href="{{url('asset/css/jquery-ui.css')}}">
@endsection

@section('breadcumb')
<a href="javascript:history.back();" class="d-none d-sm-inline-block btn btn-sm btn-primary btn-icon-split rounded mr-1">
  <span class="icon text-white-50">
    <i class="fa fa-chevron-circle-left"></i>
  </span>
</a>
@endsection

@section('content')
<form action="/register/sop/{{$data->id}}" method="POST" enctype="multipart/form-data">
@method("patch")
@csrf
  <div class="col-xs-6 col-md-6">
    <div class="card">
      <div class="card-body card-block">
        
        <div class="form-group">
          <label class="form-control-label">
            <strong>Nomor SOP</strong>
          </label>
          
          <div class="input-group">
            <input type="text" name="no_sop" class="form-control form-control-sm" value="{{$data->no_sop}}">
          </div>
        </div>
        
        <div class="row m-auto d-flex">  
          <div class="form-group flex-fill mr-2">
            <label class="form-control-label">
              <strong>Tanggal</strong>
            </label>

            <div class="input-group">
              <input type="text" name="tgl_sop" class="datepicker form-control form-control-sm" value="{{date('d F yy', $data->tgl_sop)}}">
            </div>
          </div>

          <div class="form-group flex-fill">
            <label class="form-control-label">
              <strong>Bidang sop</strong>
            </label>

            <div class="input-group">
              <select name="bidang_sop" class="chosen-select form-control form-control-lg">
                <option value="Kepaniteraan" @if($data->bidang_sop == "Kepaniteraan") selected @endif>Kepaniteraan</option>
                <option value="Sekretariat" @if($data->bidang_sop == "Kesekretariatan") selected @endif>Sekretariat</option>
              </select>
            </div>
          </div>
        </div>  

        <div class="form-group">
          <label class="form-control-label">
            <strong>Nama sop</strong>
          </label>

          <div class="input-group">
            <input type="text" name="nama_sop" class="form-control form-control-sm" value="{{$data->nama_sop}}">
          </div>
        </div>

        <div class="form-group">
          <label class="form-control-label">
            <strong>Deskpripsi</strong>
          </label>

          <div class="input-group">
            <textarea name="desc_sop" rows="4" class="form-control">{{$data->desc_sop}}</textarea>
          </div>
        </div>

      </div>
    </div>
  </div>

  <div class="col-xs-6 col-sm-6">
    <div class="card">
      <div class="card-body">
        <label class="form-control-label">
          <strong>Files</strong>
        </label>

        <div class="row my-3">
          <div class="col col-md-2">
            <i class="fas fa-file-word @if($data->pdf)text-primary @else text-secondary @endif fa-3x ml-3"></i>
          </div>
          <div class="col col-md-10">
            <div class="custom-file">
              <input type="file" name="word" class="custom-file-input" id="word">
              <label class="custom-file-label" for="word">Choose file</label>
            </div>
          </div>  
        </div>
        <div class="row">
          <div class="col col-md-2">
            <i class="fas fa-file-pdf @if($data->pdf)text-danger @else text-secondary @endif fa-3x ml-3"></i>
          </div>
          <div class="col col-md-10">
            <div class="custom-file">
              <input type="file" name="pdf" class="custom-file-input" id="pdf">
              <label class="custom-file-label" for="pdf">Choose file</label>
            </div>
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