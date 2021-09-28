@extends('layouts.app')

@section('title','Data Jabatan')

@section('tombol')
  {!!$back!!}
  {!!$tombol!!}
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
      <table class="table table-striped" style="width:100%">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Jabatan</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($data as $d)
          <tr>
            <td>{{ ($data->currentpage()-1) * $data->perpage() + $loop->index + 1 }}</td>
            <td>{{$d->nama_jabatan}}</td>
            <td class="d-flex">
              <form action="{{url('settings/referensi/jabatan')}}/{{$d->id}}" method="post">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger btn-sm btn-circle rounded mr-1"><i class="fa fa-trash"></i></button>
              </form>

              <a href="#" class="btn btn-success btn-sm btn-circle rounded editData" data-toggle="modal" data-target="#modal" data-id="{{$d->id}}" data-jab="{{$d->nama_jabatan}}"><i class="fa fa-edit"></i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      {{$data->links()}}
    </div>
  </div>
</div>
@endsection

@section('modal')
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitle">Data Jabatan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{url('settings/level')}}" method="POST" class="form-group">
        <div class="modal-body">
          <p class="patch"></p>
          @csrf
          <label>Nama Jabatan</label>
          <input type="text" class="form-control @error('nama_jabatan') is-invalid @enderror" name="nama_jabatan" id="namaJabatan" value="{{old('nama_jabatan')}}">
          @error('nama_jabatan')
          <span class="invalid-feedback" role="alert">
            <strong>{{$message}}</strong>
          </span>
          @enderror
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

<script type="text/javascript">
  $(document).ready(function() {
    $('#menu').DataTable({
      dom: 'Bfrtip',
      buttons: [
        'copy', 'excel', 'pdf'
      ]
    });

    $('#addData').on('click', function() {
      $('#modal .modal-title').html('Tambah PTA');
      $('#modal form').attr('action', `{{url('settings/referensi/jabatan')}}`);
      $('#modal button[type=submit]').html('Simpan');
      $('.patch').html('');
      $('#namaJabatan').val('');
    });

    $('.editData').on('click', function() {
      const id = $(this).data('id'),
            jab = $(this).data('jab');
        
      $('#modal .modal-title').html('Edit Jabatan');
      $('#modal form').attr('action', `{{url('settings/referensi/jabatan/`+id+`')}}`);
      $('#modal button[type=submit]').html('Update');
      $('.patch').html('@method("patch")');
      $('#namaJabatan').val(jab);
    })
  });
</script>
@endsection