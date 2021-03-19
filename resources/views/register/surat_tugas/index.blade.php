@extends('layouts.app')

@section('title','Register Surat Tugas')

@section('breadcumb')
@if(Auth::user()->id_level == 2)
<a href="/register/surat_tugas/create" class="d-none d-sm-inline-block btn btn-sm btn-primary btn-icon-split rounded">
  <span class="icon text-white-50">
    <i class="fa fa-plus"></i>
  </span>
  <span class="text"> Tambah</span>
</a>
@endif
@endsection

@section('stylesheet')
  <link href="{{url('vendors/datatables/jquery.datatables.min.css')}}" rel="stylesheet" />
  <link href="{{url('vendors/datatables/buttons.datatables.min.css')}}" rel="stylesheet" />
@endsection

@section('content')
<div class="card shadow mb-4">
  <div class="card-body">
    <div class="table-responsive">
      <table id="tabel" class="display" style="width:100%">
        <thead>
          <tr>
            <th style="width:5%">No</th>
            <th style="width:25%">Nomor Surat</th>
            <th style="width:15%">Tanggal</th>
            <th style="width:25%">Pelaksana</th>
            <th style="width:15%">Penandatangan</th>
            <th style="width:15%">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($data as $d)
          <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$d->no_stugas}}</td>
            <td>{{\App\Helpers\Helper::tanggal_id($d->tgl_stugas)}}</td>
            <td>
              <ol>
              @foreach($pgw as $p)
                @if(in_array($p->id, explode(',',$d->pegawai)))
                  <li>{{$p->nama_pegawai}}</li>
                @endif
              @endforeach
              </ol>
            </td>
            <td>{{$d->jabatan->nama_jabatan}}</td>
            <td class="d-flex">
            @if(Auth::user()->id_level == 2)
              <form action="/register/surat_tugas/{{$d->id}}" method="post">
                @csrf
                @method('delete')
                <button class="btn btn-danger btn-sm btn-circle rounded"><i class="fa fa-trash"></i></button>
              </form>
              
              <a href="{{url('register/surat_tugas/'.$d->id.'/edit')}}" class="btn btn-success btn-sm btn-circle rounded mx-1"><i class="fa fa-edit"></i></a>
            @endif
              <a href="{{url('register/surat_tugas/'.$d->id)}}" class="btn btn-primary btn-sm btn-circle rounded"><i class="fa fa-folder-open"></i></a>
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
<script src="{{url('vendors/jquery/dist/jquery.min.js')}}"></script>
<script src="{{url('vendors/datatables/jquery.datatables.min.js')}}"></script>
<script src="{{url('vendors/datatables/buttons.datatables.min.js')}}"></script>
<script src="{{url('vendors/datatables/buttons.flash.min.js')}}"></script>
<script src="{{url('vendors/datatables/buttons.html5.min.js')}}"></script>
<script src="{{url('vendors/datatables/buttons.print.min.js')}}"></script>
<script src="{{url('vendors/datatables/jzip.min.js')}}"></script>
<script src="{{url('vendors/datatables/pdfmake.min.js')}}"></script>
<script src="{{url('vendors/datatables/vfs_fonts.js')}}"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#tabel').DataTable({
      dom: 'Bfrtip',
      buttons: [
        'copy', 'excel', 'pdf'
      ]
    })
  });
</script>
@endsection
