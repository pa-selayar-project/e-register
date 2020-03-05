@extends('layouts.app')

@section('title','Edit SK')

@section('stylesheet')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.proto.js"></script>
<script>
  $(document).ready(function () {
    $(".chosen-select").chosen();
  });
</script>
@endsection

@section('content')
<div class="col-xs-6 col-md-6">
  <div class="card">
    <div class="card-body card-block">
      
      <div class="form-group">
        <label class="form-control-label">
          <strong>Nomor SK</strong>
        </label>
        
        <div class="input-group">
          <input type="text" name="nomor_sk" class="form-control" value="{{$regsk->no_sk}}">
        </div>
        <small class="form-text text-danger">@error('nomor_sk'){{$message}}@enderror</small>
      </div>
      
      <div class="form-group">
        <label class="form-control-label">
          <strong>Tanggal</strong>
        </label>

        <div class="input-group">
          <input type="date" name="tgl_sk" class="form-control" value="{{$regsk->tgl_sk}}">
        </div>
        <small class="form-text text-danger">@error('tgl_sk'){{$message}}@enderror</small>
      </div>

      <div class="form-group">
        <label class="form-control-label">
          <strong>Nama SK</strong>
        </label>

        <div class="input-group">
          <input type="text" name="nama_sk" class="form-control" value="{{$regsk->nama_sk}}">
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
          <select class="chosen-select form-control">
            <option value="Abdul Rahman Salam">Abdul Rahman Salam</option>
            <option value="Mustamin">Mustamin</option>
            <option value="Mawir">Mawir</option>
            <option value="H. Mustari">H. Mustari</option>
            <option value="Hj. Asni">Hj. Asni</option>
          </select>
        </div>
      </div>

      <div class="form-group">
        <label class="form-control-label">
          <strong>Penandatangan SK</strong>
        </label>

        <div class="input-group">
          <select class="custom-select tes">
            <option value="Ketua">Ketua</option>
            <option value="Sekretaris">Sekretaris</option>
          </select>
        </div>
      </div>

      <label class="form-control-label">
        <strong>Files</strong>
      </label>

      <div class="row my-3">
        <div class="col col-md-3">
          <a href="#"><i class="fas fa-file-word text-primary fa-3x"></i></a>
        </div>
        <div class="col col-md-9">
          <div class="custom-file">
            <input type="file" class="custom-file-input" id="customFile">
            <label class="custom-file-label" for="customFile">Choose file</label>
          </div>
        </div>  
      </div>
      <div class="row">
        <div class="col col-md-3">
          <a href="#"><i class="fas fa-file-pdf text-danger fa-3x"></i></a>
        </div>
        <div class="col col-md-9">
          <div class="custom-file">
            <input type="file" class="custom-file-input" id="customFile">
            <label class="custom-file-label" for="customFile">Choose file</label>
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
@endsection

@section('script')
@endsection