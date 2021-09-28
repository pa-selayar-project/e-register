@extends('layouts.app')

@section('title','Tahun Anggaran')

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
    <h1 class="text-center my-5 py-5">
      {{$data->thn_anggaran}}
    </h1>
  </div>
</div>
@endsection

@section('modal')
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitle">Tahun Anggaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{url('settings/referensi/ta')}}/{{$data->id}}" method="POST">
        @csrf
        @method('patch')
        <div class="modal-body">
          <div class="form-group">
            <select name="ta" id="ta" class="custom-select custom-select-lg my-3">
              @for($i=date('Y')-2;$i<=date('Y')+2;$i++)
              <option value="{{$i}}" @if($i==$data->thn_anggaran)selected @endif>{{$i}}</option>
              @endfor
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Update</button>
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
    });
  </script>
@endsection
