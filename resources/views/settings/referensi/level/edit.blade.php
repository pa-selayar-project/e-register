@extends('layouts.app')

@section('title','Edit Level')

@section('breadcumb')
<a href="javascript:history.back();" class="d-none d-sm-inline-block btn btn-sm btn-primary btn-icon-split rounded">
  <span class="icon text-white-50">
    <i class="fa fa-chevron-circle-left"></i>
  </span>
</a>
@endsection

@section('content')
<div class="row">
    <div class="col-xl-12 col-lg-12">  
      <div class="card shadow mb-4 h-100">
        <div class="card-body">
          <form method="POST" action="{{url('settings/level/'.$level->id)}}">
            @csrf
            @method('patch')
            <div class="form-group row">
              <label for="nama_level" class="col-sm-3 col-form-label">Nama Level</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="nama_level" id="nama_level" value="{{$level->nama_level}}">
                <small class="form-text text-danger">@error('nama_level'){{$message}}@enderror</small>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-12">
                <button type="submit" class="btn btn-success float-right ml-2">Update</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
</div>
@endsection