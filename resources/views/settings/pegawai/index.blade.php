@extends('layouts.app')

@section('title','Daftar Pegawai')

@section('breadcumb')
  {!!$back!!}
  {!!$tombol!!}
  <a href="{{url('settings/pegawai/trash')}}" class="ml-1 d-none d-sm-inline-block btn btn-sm btn-warning btn-icon-split rounded">
    <span class="icon text-white">
      <i class="fas fa-trash"></i>
    </span>
    <span class="text">Pegawai Pindah/Pensiun</span>
  </a>
@endsection

@section('stylesheet')
<link href="{{url('vendors/datatables/jquery.datatables.min.css')}}" rel="stylesheet" />
<link href="{{url('vendors/datatables/buttons.datatables.min.css')}}" rel="stylesheet" />
@endsection

@section('content')
<div class="card shadow mb-4">
  <div class="card-body">
    <div class="table-responsive">
      <table id="pegawai_tb" class="display" style="width:100%">
        <thead>
          <tr>
            <th style="width:5%">No</th>
            <th style="width:10%">Foto</th>
            <th style="width:30%">Nama / NIP</th>
            <th style="width:20%">Pangkat</th>
            <th style="width:25%">Jabatan</th>
            <th style="width:10%">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($data as $d)
          <tr>
            <td>{{$loop->iteration}}</td>
            <td>
              <img class="rounded-circle" src="/assets/pic/{{$d->foto}}" width="60px" height="60px"/>
            </td>
            <td>{{$d->nama_pegawai}}<br>NIP {{$d->nip}}</td>
            <td>{{$d->pangkat->nama_pangkat}} ({{$d->pangkat->golongan}})</td>
            <td>{{$d->jabatan['nama_jabatan']}}</td>
            <td class="d-flex">
              <form method="post" action="{{url('settings/pegawai')}}/{{$d->id}}">
                @csrf
                @method('delete')
                <button type="submit"class="btn btn-danger btn-sm btn-circle mr-1"><i class="fas fa-trash"></i></button> 
              </form>
              <a href="{{url('settings/pegawai/'.$d->id.'/edit')}}" class="btn btn-success btn-sm btn-circle"><i class="fas fa-edit"></i></a>
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
    $('#pegawai_tb').DataTable({
      dom: 'Bfrtip',
      buttons: [
        'copy', 'excel', 'pdf'
      ]
    });
  });
</script>
@endsection