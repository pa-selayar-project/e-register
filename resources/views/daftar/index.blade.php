@extends('layouts.app')

@section('title','Daftar User')

@section('tombol')
  {!!$back!!}
  {!!$tombol!!}
@endsection

@section('stylesheet')
<link href="{{url('vendors/datatables/jquery.datatables.min.css')}}" rel="stylesheet" />
<link href="{{url('vendors/datatables/buttons.datatables.min.css')}}" rel="stylesheet" />
@endsection

@section('content')
<div class="card shadow mb-4">
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        @foreach ($errors->all() as $error)
          <li><strong>{{ $error }}</strong> You should check in on some of those fields below.</li>
        @endforeach
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
    <div class="table-responsive">
      <table id="pegawai_tb" class="display" style="width:100%">
        <thead>
          <tr>
            <th>No</th>
            <th>Foto</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Level</th>
            <th>Aksi</th>
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
            <td>{{$user->level->nama_level}}</td>
            <td class="d-flex">
              <form action="daftar/{{$user->id}}" method="post">
                @csrf
                @method('delete')
                <button class="btn btn-danger btn-sm btn-circle rounded"><i class="fa fa-trash"></i></button>
              </form>
              
              <a href="{{url('daftar/'.$user->id.'/edit')}}" class="btn btn-success btn-sm btn-circle rounded mx-1"><i class="fa fa-edit"></i></a>
              
              <a href="{{url('daftar/'.$user->id)}}" class="btn btn-primary btn-sm btn-circle rounded"><i class="fa fa-folder-open"></i></a>
            </td>
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
          <label>Email</label>
          <div class="input-group">
            <input type="email" name="email" class="form-control" />
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