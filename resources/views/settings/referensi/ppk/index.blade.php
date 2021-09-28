@extends('layouts.app')

@section('title','PPK')

@section('tombol')
  {!!$back!!}
  {!!$tombol!!}
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
            <th>Nama PPK</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>{{$data->nama_pegawai}}</td>
          </tr>
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
        <h5 class="modal-title" id="modalTitle">Pejabat Pembuat Komitmen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{url('settings/referensi/ppk')}}" method="POST" class="form-group">
        <div class="modal-body">
          @method('patch')
          @csrf
          <label>Nama PPK</label>
          <select class="form-control" name="ppk" id="ppk">
            @foreach($select as $s)
              <option value="{{$s->id}}" @if($data->id == $s->id)selected @endif>{{$s->nama_pegawai}}</option>
            @endforeach
          </select>
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

    $('#ppk').on('change', function(){
      const id= $(this).children("option:selected").val();  
      $('.modal form').attr('action', `{{url('settings/referensi/ppk/`+id+`')}}`);
    });
  });
</script>
@endsection