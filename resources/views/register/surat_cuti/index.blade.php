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
<div class="card shadow mb-4">
  <div class="card-body">
    <div class="table-responsive">
      <table id="suratCutiList" class="display table-striped" style="width:100%">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Pegawai</th>
            <th>Nomor Permohonan / Tanggal</th>
            <th>Tanggal Cuti</th>
            <th>Sisa Cuti</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($data as $d)
          <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$d->pegawai->nama_pegawai}}</td>
            <td>{{$d->no_cuti}}<br>Tgl. {{$d->tgl_cuti}}</td>
            <td>{{$d->mulai}} s.d {{$d->akhir}}</td>
            <td>{{$d->pegawai->sisa_cuti}}</td>
            <td>
              <a href="#" class="btn btn-danger btn-sm btn-circle "><i class="fas fa-trash"></i></a>
              <a href="#" class="btn btn-success btn-sm btn-circle"><i class="fas fa-edit"></i></a>
              <a href="#" class="btn btn-success btn-sm btn-circle"><i class="fas fa-info-circle"></i></a>
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