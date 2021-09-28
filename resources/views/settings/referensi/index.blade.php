@extends('layouts.app')

@section('title','Referensi')

@section('tombol')
  {!!$back!!}
  {!!$tombol!!}
@endsection

@section('content')
  @forelse ($data as $d)
    <div class="col-lg-3 col-md-6">
      <div class="card">
        <div class="py-0 clearfix">
          <i class="fa-2x {{$d->icon}} p-4 float-left text-light"></i>
          <div class="h5 mt-3 text-center">
            <a href="{{url($d->link)}}" class="text-primary text-decoration-none">
              {{$d->nama_referensi}}
            </a>
          </div>
          <div class="text-muted text-center text-decoration-none"><a class="editData" href=# data-toggle="modal" data-target="#modal" data-id="{{$d->id}}">edit</a></div>
        </div>
      </div>
    </div>
  @empty
    <div class="col-lg-12 col-md-12 bg-secondary">
      <h1 class="text-center text-light py-5 my-5">Tidak ada data</h1>
    </div>
  @endforelse
@endsection

@section('modal')
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitle">Tambah Referensi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{url('settings/referensi')}}" method="POST" class="form-group">
        <div class="modal-body">
          <p class="patch"></p>
          @csrf
          <label>Nama Referensi</label>
          <input type="text" class="form-control @error('nama_referensi') is-invalid @enderror" name="nama_referensi" id="namaReferensi" value="{{old('nama_referensi')}}">
          @error('nama_referensi')
          <span class="invalid-feedback" role="alert">
            <strong>{{$message}}</strong>
          </span>
          @enderror

          <label>Icon Referensi</label>
          <input type="text" class="form-control @error('icon') is-invalid @enderror" name="icon" id="icon" value="{{old('icon')}}">
          @error('icon')
          <span class="invalid-feedback" role="alert">
            <strong>{{$message}}</strong>
          </span>
          @enderror

          <label>Link Referensi</label>
          <input type="text" class="form-control @error('link') is-invalid @enderror" name="link" id="link" value="{{old('link')}}">
          @error('link')
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
    $(document).ready(function(){
      $('#addData').on('click', function() {
        $('#modal .modal-title').html('Tambah Referensi');
        $('#modal form').attr('action', `{{url('settings/referensi')}}`);
        $('#modal button[type=submit]').html('Simpan');
        $('.patch').html('');
        $('#namaReferensi').val('');
        $('#icon').val('');
        $('#link').val('');
      });

      $('.editData').on('click', function() {
        const id = $(this).data('id');

        $('#modal .modal-title').html('Edit Referensi');
        $('#modal form').attr('action', `{{url('settings/referensi/`+id+`')}}`);
        $('#modal button[type=submit]').html('Update');
        $('.patch').html('@method("patch")');

        $.ajax({
          type: 'GET',
          url:'referensi/'+id+'/hasil',
          success:function(result){
            $('#namaReferensi').val(result.nama_referensi);
            $('#icon').val(result.icon);
            $('#link').val(result.link);
          }
        })
      });
    }
  );
</script>
@endsection