@extends('layouts.app')

@section('title','Tambah Pramubakti')

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
                  <option value="Pramubhakti">Pramubhakti</option>
                  <option value="Security">Security</option>
                  <option value="Driver">Driver</option>
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