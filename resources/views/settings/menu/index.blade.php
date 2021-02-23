@extends('layouts.app')

@section('title','Menu')

@section('breadcumb')
<a href="#" id="addData" data-toggle="modal" data-target="#modal" class="d-none d-sm-inline-block btn btn-sm btn-primary btn-icon-split rounded">
  <span class="icon text-white-50">
    <i class="fa fa-plus"></i>
  </span>
  <span class="text">Tambah Menu</span>
</a>
@endsection

@section('stylesheet')
<link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet" />
<link href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css" rel="stylesheet" />
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
      <table id="menu" class="display" style="width:100%">
        <thead>
          <tr>
            <th>No</th>
            <th>Icon</th>
            <th>Nama Menu</th>
            <th>Parent Menu</th>
            <th>Link</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($data as $d)
          <tr>
            <td>{{$loop->iteration}}</td>
            <td><i class="{{$d->icon}}"></i></td>
            <td>{{$d->nama_menu}}</td>
            <td>{{$d->headmenu->nama_head}}</td>
            <td>{{$d->link}}</td>
            <td>
              <a href="#" class="btn btn-danger btn-sm btn-circle hapusData"><i class="fa fa-trash"></i></a>

              <a href="#" class="btn btn-success btn-sm btn-circle editData" data-toggle="modal" data-target="#modal" data-id="{{$d->id}}" data-nama="{{$d->nama_menu}}" data-head="{{$d->headmenu_id}}" data-link="{{$d->link}}" data-icon="{{$d->icon}}"><i class="fa fa-edit"></i></a>
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
        <h5 class="modal-title" id="modalTitle">Menu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{url('settings/menu')}}" method="POST" class="form-group">
        <div class="modal-body">
          <p class="patch"></p>
          @csrf
          <label>Nama Menu</label>
          <input type="text" class="form-control @error('nama_menu') is-invalid @enderror" name="nama_menu" id="namaMenu" value="{{old('nama_menu')}}">
          @error('nama_menu')
          <span class="invalid-feedback" role="alert">
            <strong>{{$message}}</strong>
          </span>
          @enderror

          <label>Icon Menu</label>
          <input type="text" class="form-control @error('icon') is-invalid @enderror" name="icon" id="icon" value="{{old('icon')}}">
          @error('icon')
          <span class="invalid-feedback" role="alert">
            <strong>{{$message}}</strong>
          </span>
          @enderror

          <label>Link Menu</label>
          <input type="text" class="form-control @error('link') is-invalid @enderror" name="link" id="link" value="{{old('link')}}">
          @error('link')
          <span class="invalid-feedback" role="alert">
            <strong>{{$message}}</strong>
          </span>
          @enderror

          <label>Parent Menu</label>
          <select class="form-control" name="headmenu_id" id="head">
            @foreach($head as $h)
            <option value="{{$h->id}}">{{$h->nama_head}}</option>
            @endforeach
          </select>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
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
    $('#menu').DataTable({
      dom: 'Bfrtip',
      buttons: [
        'copy', 'excel', 'pdf'
      ]
    });

    $('#addData').on('click', function() {
      $('#modal .modal-title').html('Tambah Menu');
      $('#modal form').attr('action', `{{url('settings/menu')}}`);
      $('#modal button[type=submit]').html('Save');
      $('.patch').html('');
      $('#namaMenu').val('');
      $('#icon').val('');
      $('#link').val('');
      $('#head').val(1);
    });

    $('.editData').on('click', function() {
      const id = $(this).data('id'),
        nama = $(this).data('nama'),
        icon = $(this).data('icon'),
        link = $(this).data('link'),
        head = $(this).data('head');

      $('#modal .modal-title').html('Edit Menu');
      $('#modal form').attr('action', `{{url('settings/menu/` + id + `')}}`);
      $('#modal button[type=submit]').html('Update');
      $('.patch').html('@method("patch")');
      $('#namaMenu').val(nama);
      $('#head').val(head);
      $('#link').val(link);
      $('#icon').val(icon);
    });

  });
</script>
@endsection