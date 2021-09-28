@extends('layouts.app')

@section('title','Data Pangkat')

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
            <th>Nama Pangkat</th>
            <th>Golongan/Ruang</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($data as $d)
          <tr>
            <td>{{ ($data->currentpage()-1) * $data->perpage() + $loop->index + 1 }}</td>
            <td>{{$d->nama_pangkat}}</td>
            <td>{{$d->golongan}}</td>
            <td class="d-flex">
              <a href="#" class="btn btn-danger btn-sm btn-circle mr-1 rounded swalConfirm" data-id="{{$d->id}}"><i class="fa fa-trash"></i></a>

              <form action="{{url('settings/referensi/pangkat')}}/{{$d->id}}" method="post" id="delete{{$d->id}}">
                @csrf
                @method('delete')
              </form>

              <a href="#" class="btn btn-success btn-sm btn-circle rounded editData" data-toggle="modal" data-target="#modal" data-id="{{$d->id}}" data-pang="{{$d->nama_pangkat}}" data-gol="{{$d->golongan}}"><i class="fa fa-edit"></i></a>
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
        <h5 class="modal-title" id="modalTitle">Data Pangkat</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{url('settings/referensi/pangkat')}}" method="POST" class="form-group">
        <div class="modal-body">
          <p class="patch"></p>
          @csrf
          <label>Nama Pangkat</label>
          <input type="text" class="form-control @error('nama_pangkat') is-invalid @enderror" name="nama_pangkat" id="namaPangkat" value="{{old('nama_pangkat')}}">
          @error('nama_pangkat')
          <span class="invalid-feedback" role="alert">
            <strong>{{$message}}</strong>
          </span>
          @enderror
          <label>Golongan/Ruang</label>
          <input type="text" class="form-control @error('golongan') is-invalid @enderror" name="golongan" id="golongan" value="{{old('golongan')}}">
          @error('golongan')
          <span class="invalid-feedback" role="alert">
            <strong>{{$message}}</strong>
          </span>
          @enderror
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
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
    $('.swalConfirm').on('click',function(){
      const id=$(this).data('id');
      Swal.fire({
        title: 'Yakin mau dihapus?',
        text: "Hubungi admin untuk mengembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oke!'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Terhapus!',
            'File telah dihapus.',
            'success'
          )}
          $('#delete'+id).submit();
      })
    });

    $('#addData').on('click', function() {
      $('#modal .modal-title').html('Tambah Pangkat');
      $('#modal form').attr('action', `{{url('settings/referensi/pangkat')}}`);
      $('#modal button[type=submit]').html('Simpan');
      $('.patch').html('');
      $('#namaPangkat').val('');
      $('#golongan').val('');
    });

    $('.editData').on('click', function() {
      const id = $(this).data('id'),
            pang = $(this).data('pang'),
            gol = $(this).data('gol');
        
      $('#modal .modal-title').html('Edit Pangkat');
      $('#modal form').attr('action', `{{url('settings/referensi/pangkat/`+id+`')}}`);
      $('#modal button[type=submit]').html('Update');
      $('.patch').html('@method("patch")');
      $('#namaPangkat').val(pang);
      $('#golongan').val(gol);
    })
  });
</script>
@endsection