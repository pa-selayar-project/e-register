@extends('layouts.app')

@section('title','Detail SK')

@section('content')
<div class="card shadow mb-4">
  <div class="card-body">
    <div class="table-responsive-xl">
      <table class="table table-striped table-bordered" style="width:100%">
        <tr>
          <th>Nomor & Tgl SK</th>
          <th>Perihal</th>
          <th>Files</th>
        </tr>
        <tr height="300px">
          <td class="pt-5">{{$regsk->no_sk}} <br> Tanggal {{$regsk->tgl_sk}}</td>
          <td class="pt-5">{{$regsk->desc_sk}}</td>
          <td class="pt-5 d-inline-flex border-0">
            <a href="#" class="mr-3"><i class="fas fa-file-word text-primary fa-2x"></i></a>
            <a href="#"><i class="fas fa-file-pdf text-danger fa-2x"></i></a>
          </td>
        </tr>
      </table>
    </div>
  </div>
</div>
@endsection