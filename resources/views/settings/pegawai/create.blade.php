@extends('layouts.app')

@section('title','Tambah Pegawai')

@section('content')
<div class="row">
    <div class="col-xl-12 col-lg-12">  
      <div class="card shadow mb-4 h-100">
        <div class="card-body">
          <form method="POST" action="{{url('settings/pegawai')}}">
            @csrf
            <div class="form-group row">
              <label for="name" class="col-sm-3 col-form-label">Nama Lengkap</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="name" id="name" value="{{old('name')}}">
                <small class="form-text text-danger">@error('name'){{$message}}@enderror</small>
              </div>
            </div>
            <div class="form-group row">
              <label for="nip" class="col-sm-3 col-form-label">NIP</label>
              <div class="col-sm-9">
                <input type="number" min="195001011970011000" class="form-control" id="nip" name="nip" value="{{old('nip')}}">
                <small class="form-text text-danger">@error('nip'){{$message}}@enderror</small>
              </div>
            </div>
            <div class="form-group row">
              <label for="pangkat" class="col-sm-3 col-form-label">pangkat</label>
              <div class="col-sm-9">
                <select name="pangkat" id="pangkat" class="form-control">
                  @foreach($pangkat as $pgkt)
                    <option value="{{$pgkt->id}}">{{$pgkt->nama_pangkat}} ({{$pgkt->golongan}})</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="jabatan" class="col-sm-3 col-form-label">Jabatan</label>
              <div class="col-sm-9">
                <select name="jabatan" id="jabatan" class="form-control">
                  @foreach($jabatan as $jbt)
                    <option value="{{$jbt->nama_jabatan}}">{{$jbt->nama_jabatan}}</option>
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