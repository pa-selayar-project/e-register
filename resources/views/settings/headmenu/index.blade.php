@extends('layouts.app')

@section('title','Head Menu')

@section('tombol')
<a href="#" id="addData" data-toggle="modal" data-target="#modal" class="d-none d-sm-inline-block btn btn-sm btn-primary btn-icon-split">
  <span class="icon text-white-50">
    <i class="fas fa-plus"></i>
  </span>
  <span class="text">Add Data</span>
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
      <table id="headMenu" class="display" style="width:100%">
        <thead>
          <tr>
            <th>No</th>
            <th>Head Menu</th>
            <th>Place</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($data as $d)
          <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$d->nama_head}}</td>
            <td>{{($d->place==1)?'Navbar':'Sidebar'}}</td>
            <td>
              <a href="#" class="btn btn-danger btn-sm btn-circle hapusData"><i class="fa fa-trash"></i></a>
              <a href="#" class="btn btn-success btn-sm btn-circle editData" data-toggle="modal" data-target="#modal" data-id="{{$d->id}}" data-head="{{$d->nama_head}}" data-place="{{$d->place}}"><i class="fa fa-edit"></i></a>
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
        <h5 class="modal-title" id="modalTitle">Head Menu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{url('settings/parent_menu')}}" method="POST" class="form-group">
        <div class="modal-body">
          @method('PATCH')
          @csrf
          <label>Nama Headmenu</label>
          <input type="text" class="form-control @error('nama_head') is-invalid @enderror" name="nama_head" id="namaHead" value="{{old('nama_head')}}">
          @error('nama_head')
          <span class="invalid-feedback" role="alert">
            <strong>{{$messages}}</strong>
          </span>
          @enderror

          <label>Lokasi Menu</label>
          <select class="form-control" name="place" id="place" value="{{old('place')}}">
            <option value=1>Navbar</option>
            <option value=2>Sidebar</option>
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
    $('#headMenu').DataTable({
      dom: 'Bfrtip',
      buttons: [
        'copy', 'excel', 'pdf'
      ]
    });

    $('#addData').on('click', function() {
      $('#modal .modal-title').html('Tambah Headmenu');
      $('#modal form').attr('action', `{{url('settings/parent_menu')}}`);
      $('#modal button[type=submit]').html('Save');
      $('.patch').html('');
      $('#namaHead').val('');
      $('#place').val('');
    });

    $('.editData').on('click', function() {
      const id = $(this).data('id'),
        nama = $(this).data('head'),
        place = $(this).data('place');

      $('#modal .modal-title').html('Edit Headmenu');
      $('#modal form').attr('action', `{{url('settings/parent_menu/` + id + `')}}`);
      $('#modal button[type=submit]').html('Update');
      $('.patch').html('@method("patch")');
      $('#namaHead').val(nama);
      $('#place').val(place);
    });

  });
</script>
@endsection