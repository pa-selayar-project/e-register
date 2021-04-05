@extends('layouts.app')

@section('title','Register Surat Cuti')

@section('breadcumb')
<a href="{{url('register/surat_cuti/create')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary btn-icon-split">
  <span class="icon text-white-50">
    <i class="fas fa-plus"></i>
  </span>
  <span class="text"> Tambah</span>
</a>
@endsection

@section('stylesheet')
<link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet" />
<link href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css" rel="stylesheet" />
@endsection

@section('content')
<?php

use App\Helpers\Helper; ?>
<div class="card shadow mb-4">
  <div class="card-body">
    <div class="table-responsive">
      <table id="suratCutiList" class="display table-striped" style="width:100%">
        <thead>
          <tr>
            <th style="width:5%">No</th>
            <th style="width:25%">Nama Pegawai</th>
            <th style="width:25%">Nomor Permohonan / Tanggal</th>
            <th style="width:25%">Tanggal Cuti</th>
            <th style="width:10%">Sisa Cuti</th>
            <th style="width:10%">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($data as $d)
          <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$d->pegawai->nama_pegawai}}</td>
            <td>{{$d->no_cuti}}
              <div>Tgl. {{Helper::tanggal_id($d->tgl_cuti)}}</div>
            </td>
            <td>{{Helper::tanggal_id($d->mulai)}} s.d {{Helper::tanggal_id($d->akhir)}}</td>
            <td>{{$d->sisa_cuti}}</td>
            <td class="d-flex">
            @if(Auth::user()->id_level == 2)
              <form method="post" action="/register/surat_cuti/{{$d->id}}">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger btn-sm btn-circle rounded">
                  <i class="fas fa-trash"></i>
                </button>
              </form>
              <a href="surat_cuti/{{$d->id}}/edit" class="btn btn-success btn-sm btn-circle rounded mx-1"><i class="fas fa-edit"></i></a>
            @endif
              <a href="surat_cuti/{{$d->id}}" class="btn btn-primary btn-sm btn-circle rounded"><i class="fas fa-folder-open"></i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#suratCutiList').DataTable({
      dom: 'Bfrtip',
      buttons: [
        'copy', 'excel', 'pdf'
      ]
    });
  });
</script>
@endsection