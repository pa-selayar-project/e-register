@extends('layouts.app')

@section('title','Database')

@section('breadcumb')
<a href="{{url('settings')}}" class="d-none d-sm-inline-block btn btn-sm btn-danger btn-icon-split rounded">
  <span class="icon text-white-50">
    <i class="fa fa-arrow-circle-left"></i>
  </span></a>
@endsection

@section('content')
<div class="card shadow mb-4">
  <div class="card-body">
    <div class="col-lg-6 col-md-6">
      <div class="card">
        <div class="card-header">
          <strong class="card-title mb-3">Input Massal SK Tahun Ini</strong>
        </div>
        <form action="#" method="post" type="multipart/form-data">
        @csrf
        <div class="card-body">
          <div class="custom-file">
              <input type="file" name="xls" class="custom-file-input @error('xls') is-invalid @enderror" id="xls">
              <label class="custom-file-label" for="word">Choose file</label>
              @error('xls')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
              @enderror
            </div>
        </div>
        <div class="card-footer">
          <input type="submit" class="btn btn-outline-primary" value="Upload">
        </div>
        </form>
      </div>
    </div>
    <div class="col-lg-6 col-md-6">
      <div class="card">
        <div class="card-header">
          <strong class="card-title mb-3">Resume Aplikasi</strong>
        </div>
        <div class="card-body">

        </div>
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