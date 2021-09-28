@extends('layouts.app')

@section('title','PTA')

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
      <table id="tabel" class="display" style="width:100%">
        <thead>
          <tr>
            <th style="width:5%">No</th>
            <th style="width:40%">Nama PTA</th>
            <th style="width:40%">Ketua PTA</th>
            <th style="width:15%">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($data as $d)
          <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$d->nama_pta}}<br/>{{$d->alamat}}</td>
            <td>{{$d->ketua}}<br/>NIP {{$d->nip}}</td>
            <td class="d-flex">
              <form action="{{url('settings/referensi/pta')}}/{{$d->id}}" method="post">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger btn-sm btn-circle rounded"><i class="fa fa-trash"></i></button>
              </form>
              
              <a href="#" class="editData btn btn-success btn-sm btn-circle rounded mx-1" data-toggle="modal" data-target="#modal" data-id="{{$d->id}}"><i class="fa fa-edit"></i></a>
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
        <h5 class="modal-title" id="modalTitle">Tambah PTA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{url('settings/referensi/pta')}}" method="POST">
        <p class="patch"></p>
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label for="nama_pta">Nama PTA</label>
            <input type="text" class="form-control" name="nama_pta" id="namaPta">
          </div>
          <div class="form-group">
            <label for="alamat">Alamat</label>
            <input type="text" class="form-control" name="alamat" id="alamat">
          </div>
          <div class="form-group">
            <label for="ketua">Nama Ketua</label>
            <input type="text" class="form-control" name="ketua" id="ketua">
          </div>
          <div class="form-group">
            <label for="nip">Nip</label>
            <input type="text" class="form-control" name="nip" id="nip">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Tambah</button>
        </div>
      </form>
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
    
      $('#addData').on('click', function() {
        $('#modal .modal-title').html('Tambah PTA');
        $('#modal form').attr('action', `{{url('settings/referensi/pta')}}`);
        $('#modal button[type=submit]').html('Simpan');
        $('.patch').html('');
        $('#namaPta').val('');
        $('#alamat').val('');
        $('#ketua').val('');
        $('#nip').val('');
      });

      $('.editData').on('click', function() {
        const id = $(this).data('id');
        
        $('#modal .modal-title').html('Edit PTA');
        $('#modal form').attr('action', `{{url('settings/referensi/pta/`+id+`')}}`);
        $('#modal button[type=submit]').html('Update');
        $('.patch').html('@method("patch")');

        $.ajax({
          type: 'GET',
          url:'pta/'+id+'/hasil',
          success:function(result){
            $('#namaPta').val(result.nama_pta);
            $('#alamat').val(result.alamat);
            $('#ketua').val(result.ketua);
            $('#nip').val(result.nip);
          }
        })
      });
    });
  </script>
@endsection
