@extends('layouts.app')

@section('title','Tambah Pramubakti')

@section('breadcumb')
<a href="#" onclick="javascript:history.back();" class="ml-1 d-none d-sm-inline-block btn btn-sm btn-danger">
  <span class="icon text-white">
    <i class="fas fa-arrow-alt-circle-left"></i>
  </span>
</a>
@endsection

@section('content')
<div class="row">
    <div class="col-xl-12 col-lg-12">  
      <div class="card shadow mb-4 h-100">
        <div class="card-body">
          <form method="POST" action="{{url('settings/pramubhakti')}}">
            @csrf
            <div class="form-group row">
              <label for="name" class="col-sm-3 col-form-label">Nama Lengkap</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="name" id="name" value="{{old('name')}}">
                <small class="form-text text-danger">@error('name'){{$message}}@enderror</small>
              </div>
            </div>
            <div class="form-group row">
              <label for="jabatan" class="col-sm-3 col-form-label">Jabatan</label>
              <div class="col-sm-9">
                <select name="jabatan" id="jabatan" class="form-control">
                  @foreach($jabatan as $j)
                    <option value="{{$j->id}}">{{$j->nama_jabatan}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-12">
                <button type="submit" class="btn btn-success float-right ml-2">Simpan</button>
                <button type="reset" class="btn btn-secondary float-right">Reset</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
</div>
@endsection