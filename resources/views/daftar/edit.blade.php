@extends('layouts.app')

@section('title','Edit User')

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
          <form method="POST" action="{{url('daftar/'.$daftar->id)}}">
            @csrf
            @method('patch')
            <div class="form-group row">
              <label for="name" class="col-sm-3 col-form-label">Username</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="name" id="name" value="{{$daftar->name}}">
                <small class="form-text text-danger">@error('name'){{$message}}@enderror</small>
              </div>
              <label for="email" class="col-sm-3 col-form-label">Email</label>
              <div class="col-sm-9">
                <input type="email" class="form-control" name="email" id="email" value="{{$daftar->email}}">
                <small class="form-text text-danger">@error('email'){{$message}}@enderror</small>
              </div>
              <label for="level" class="col-sm-3 col-form-label">level</label>
              <div class="col-sm-9">
                <select name="level" id="level" class="form-control">
                  @foreach($level as $lvl)
                    <option value="{{$lvl->id}}">{{$lvl->nama_level}}</option>
                  @endforeach
                </select>
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