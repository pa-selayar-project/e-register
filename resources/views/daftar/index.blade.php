@extends('layouts.app')

@section('title','Daftar User')

@section('breadcumb')
<a href="#" id="addData" data-toggle="modal" data-target="#modal" class="d-none d-sm-inline-block btn btn-sm btn-primary btn-icon-split rounded mr-1">
  <span class="icon text-white">
    <i class="fas fa-plus"></i>
  </span>
  <span class="text">Rekam User</span>
</a>
<a href="javascript:history.back();" class="d-none d-sm-inline-block btn btn-sm btn-primary btn-icon-split rounded mr-1">
  <span class="icon text-white-50">
    <i class="fa fa-chevron-circle-left"></i>
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
    <div class="table-responsive">
      <table id="pegawai_tb" class="display" style="width:100%">
        <thead>
          <tr>
            <th>No</th>
            <th>Foto</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Level</th>
          </tr>
        </thead>
        <tbody>
          @foreach($users as $user)
          <tr>
            <td>{{$loop->iteration}}</td>
            <td>
              <img class="rounded-circle" src="/assets/pic/{{$user->image}}" width="60px" height="60px"/>
            </td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>@if($user->level == 1)Admin @else User @endif</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection

@section('modal')
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitle">Tambah User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{url('daftar')}}" method="POST" class="form-group">
        <div class="modal-body">
          @csrf
          <label>Nama Pegawai</label>
          <div class="input-group">
            <select class="form-control" name="pgw">
              @foreach($pgw as $pgw)
                <option value="{{$pgw->id}}">
                  {{$pgw->nama_pegawai}}
                </option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Generate</button>
        </div>
      </form>
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