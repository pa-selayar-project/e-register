@extends('layouts.app')

@section('title','Register SOP')

@section('breadcumb')
<a href="#" id="addData" data-toggle="modal" data-target="#modal" class="d-none d-sm-inline-block btn btn-sm btn-primary btn-icon-split rounded">
  <span class="icon text-white-50">
    <i class="fa fa-plus"></i>
  </span>
  <span class="text">Tambah</span>
</a>
@endsection

@section('stylesheet')
  <link href="{{url('vendors/datatables/jquery.datatables.min.css')}}" rel="stylesheet" />
  <link href="{{url('vendors/datatables/buttons.datatables.min.css')}}" rel="stylesheet" />
@endsection

@section('content')
<div class="card shadow mb-4">
  <div class="card-body">
    <div class="table-responsive">
      <table id="tabel" class="display" style="width:100%">
        <thead>
          <tr>
            <th style="width:5%">No</th>
            <th style="width:15%">Nomor SOP</th>
            <th style="width:20%">Tanggal</th>
            <th style="width:30%">Deskripsi SOP</th>
            <th style="width:15%">Bidang</th>
            <th style="width:15%">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($data as $d)
          <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$d->no_sop}}</td>
            <td>{{\App\Helpers\Helper::tanggal_id($d->tgl_sop)}}</td>
            <td>{{$d->desc_sop}}</td>
            <td>{{$d->bidang_sop}}</td>
            <td class="d-flex">
              <form action="/register/sop/{{$d->id}}" method="post">
                @csrf
                @method('delete')
                <button class="btn btn-danger btn-sm btn-circle rounded"><i class="fa fa-trash"></i></button>
              </form>
              
              <a href="{{url('register/sop/'.$d->id.'/edit')}}" class="btn btn-success btn-sm btn-circle rounded mx-1"><i class="fa fa-edit"></i></a>
              
              <a href="{{url('register/sop/'.$d->id)}}" class="btn btn-primary btn-sm btn-circle rounded"><i class="fa fa-folder-open"></i></a>
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
        <h5 class="modal-title" id="modalTitle">Tambah SOP</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{url('register/sop')}}" method="POST">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label for="noSk">Nomor SOP</label>
            <input type="text" class="form-control" name="no_sop" id="noSop">
          </div>
          <div class="form-group">
            <label for="namaSk">Nama SOP</label>
            <input type="text" class="form-control" name="nama_sop" id="namaSop" >
          </div>
          <div class="row">
            <div class="form-group col">
              <label for="tglSk">Tanggal</label>
              <input type="date" class="form-control" name="tgl_sop" id="tglSop" autocomplete="off">
            </div>
            <div class="form-group col">
              <label for="bidang">Bidang</label>
              <select class="form-control" name="bidang_sop" id="bidang">
                <option value="Kepaniteraan">Kepaniteraan</option>
                <option value="Kesekretariatan">Kesekretariatan</option>
              </select>
            </div>
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
  });
</script>

@endsection
