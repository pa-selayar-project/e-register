@extends('layouts.app')

@section('title','Daftar Pramubhakti')

@section('breadcumb')
<a href="{{url('settings/pramubhakti/create')}}" class="mr-1 d-none d-sm-inline-block btn btn-sm btn-primary btn-icon-split">
  <span class="icon text-white-50">
    <i class="fas fa-plus"></i>
  </span>
  <span class="text">Rekam Pramubhakti</span>
</a>
<a href="{{url('settings')}}" class="ml-1 d-none d-sm-inline-block btn btn-sm btn-danger">
  <span class="icon text-white">
    <i class="fas fa-arrow-alt-circle-left"></i>
  </span>
</a>
@endsection

@section('stylesheet')
<link href="{{url('vendors/datatables/jquery.datatables.min.css')}}" rel="stylesheet" />
<link href="{{url('vendors/datatables/buttons.datatables.min.css')}}" rel="stylesheet" />
@endsection

@section('content')
<div class="card shadow mb-4">
  <div class="card-body">
    @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif

    @if (session('message'))
    <div class=" alert alert-success">
      {{ session('message') }}
    </div>
    @endif
  
    <div class="table-responsive">
      <table id="pegawai_tb" class="display" style="width:100%">
        <thead>
          <tr>
            <th>No</th>
            <th>Foto</th>
            <th>Nama</th>
            <th>Jabatan</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($data as $d)
          <tr>
            <td>{{$loop->iteration}}</td>
            <td> 
              @if($d->foto)
              <img class="rounded-circle" src="/assets/pic/{{$d->foto}}" width="60px" height="60px"/>
              @else
              <img class="rounded-circle" src="/assets/pic/user.png" width="60px" height="60px"/>
              @endif
            </td>
            <td>{{$d->nama_pegawai}}</td>
            <td>{{$d->jabatan->nama_jabatan}}</td>
            <td class="d-flex">
              <form method="post" action="{{url('settings/pramubhakti')}}/{{$d->id}}">
                @csrf
                @method('delete')
                <button type="submit"class="btn btn-danger btn-sm btn-circle mr-1"><i class="fas fa-trash"></i></button> 
              </form>
              <a href="{{url('settings/pramubhakti/'.$d->id.'/edit')}}" class="btn btn-success btn-sm btn-circle"><i class="fas fa-edit"></i></a>
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
<!-- <script src="https://code.jquery.com/jquery-3.3.1.js"></script> -->
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