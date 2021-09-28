@extends('layouts.app')

@section('title','DIPA')

@section('stylesheet')
  <link rel="stylesheet" href="{{url('asset/css/jquery-ui.css')}}">
  <link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet" />
  <link href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css" rel="stylesheet" />
@endsection

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
        <table id="menu" class="display" style="width:100%">
          <thead>
            <tr>
              <th>No</th>
              <th>Nomor DIPA</th>
              <th>Tanggal</th>
              <th>Tahun</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse($data as $d)
            <tr>
              <td>{{$loop->iteration}}</td>
              <td>{{$d->nomor_dipa}}</td>
              <td>{{date('d F Y', $d->tanggal)}}</td>
              <td>{{date('Y',$d->tanggal)+1}}</td>
              <td class="d-flex">
                <form action="{{url('settings/referensi/dipa')}}/{{$d->id}}" method="post">
                  @csrf
                  @method('delete')
                  <button type="submit" class="btn btn-danger btn-sm btn-circle rounded mr-1"><i class="fa fa-trash"></i></button>
                </form>

                <a href="#" class="btn btn-success btn-sm btn-circle rounded editData" data-toggle="modal" data-target="#modal" data-id="{{$d->id}}"><i class="fa fa-edit"></i></a>
              </td>
            </tr>
            @empty
            <div class="bg-secondary">
              <h1 class="text-center text-light py-5 my-5">Tidak ada data</h1>
            </div>
            @endforelse 
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
          <h5 class="modal-title" id="modalTitle">Tambah Data DIPA</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{url('settings/Data Dipa/dipa')}}" method="POST" class="form-group">
          <div class="modal-body">
            <p class="patch"></p>
            @csrf
            <label>Nomor DIPA</label>
            <input type="text" class="form-control @error('nomor_dipa') is-invalid @enderror" name="nomor_dipa" id="nomorDipa" value="{{old('nomor_dipa')}}">
            @error('nomor_dipa')
            <span class="invalid-feedback" role="alert">
              <strong>{{$message}}</strong>
            </span>
            @enderror

            <label>Tanggal</label>
            <input type="text" class="datepicker form-control @error('tanggal') is-invalid @enderror" name="tanggal" id="tanggal" value="{{old('tanggal')}}">
            @error('tanggal')
            <span class="invalid-feedback" role="alert">
              <strong>{{$message}}</strong>
            </span>
            @enderror
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
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
  <script src="{{url('asset/js/jquery-ui.js')}}"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      $('#menu').DataTable({
      dom: 'Bfrtip',
      buttons: [
        'copy', 'excel', 'pdf'
      ]
      });

      $('#addData').on('click', function() {
        $('#modal .modal-title').html('Tambah Data Dipa');
        $('#modal form').attr('action', `{{url('settings/referensi/dipa')}}`);
        $('#modal button[type=submit]').html('Simpan');
        $('.patch').html('');
        $('#nomorDipa').val('');
        $('#tanggal').val('');
      });

      $('.editData').on('click', function() {
        const id = $(this).data('id');
        $('#modal .modal-title').html('Edit Data Dipa');
        $('#modal form').attr('action', `{{url('settings/referensi/dipa/`+id+`')}}`);
        $('#modal button[type=submit]').html('Update');
        $('.patch').html('@method("patch")');

        $.ajax({
          type: 'GET',
          url:'dipa/'+id+'/hasil',
          success:function(result){
            $('#nomorDipa').val(result.nomor_dipa);
            $('#tanggal').val(result.tanggal);
          }
        })
      });

      $( ".datepicker" ).datepicker({
          dateFormat: "dd MM yy"
      });
    }
  );
  </script>
@endsection