@extends('layouts.app')

@section('title','Register SK')

@section('breadcumb')
<a href="#" id="addData" data-toggle="modal" data-target="#modal" class="d-none d-sm-inline-block btn btn-sm btn-primary btn-icon-split rounded">
  <span class="icon text-white-50">
    <i class="fa fa-plus"></i>
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
    @if ($errors->any())
    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
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
            <th style="width:30%">Nomor & Tgl SK</th>
            <th style="width:30%">Tentang</th>
            <th style="width:10%">Bidang</th>
            <th style="width:10%">Penandatangan</th>
            <th style="width:15%">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($data as $d)
          <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$d->no_sk}} <br> 
              Tgl. {{ date('d M Y', $d->tgl_sk)}}
            </td>
            <td>{{$d->nama_sk}}</td>
            <td>{{$d->bidang_sk}}</td>
            <td>{{$d->ttd_sk}}</td>
            <td>
              <a href="#" class="btn btn-danger btn-sm btn-circle rounded"><i class="fa fa-trash"></i></a>

              <a href="{{url('register/regsk/'.$d->id.'/edit')}}" class="btn btn-success btn-sm btn-circle rounded"><i class="fa fa-edit"></i></a>
              
              <a href="{{url('register/regsk/'.$d->id)}}" class="btn btn-primary btn-sm btn-circle rounded"><i class="fa fa-folder-open"></i></a>
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
        <h5 class="modal-title" id="modalTitle">Tambah SK</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{url('register/regsk')}}" method="POST">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label for="noSk">Nomor SK</label>
            <input type="text" class="form-control" name="no_sk" id="noSk" placeholder="W20-A17/ .... /HK.05/I/2020">
          </div>
          <div class="form-group">
            <label for="namaSk">Nama SK</label>
            <input type="text" class="form-control" name="nama_sk" id="namaSk" >
          </div>
          <div class="row">
            <div class="form-group col">
              <label for="tglSk">Tanggal SK</label>
              <input type="date" class="form-control" name="tgl_sk" id="tglSk">
            </div>
            <div class="form-group col">
              <label for="bidang">Bidang</label>
              <select class="form-control" name="bidang_sk" id="bidang">
                <option value="Kepaniteraan">Kepaniteraan</option>
                <option value="Kesekretariatan">Kesekretariatan</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="ttd">Penandatangan SK</label>
            <select class="form-control" name="ttd_sk" id="ttd">
              <option value="Ketua">Ketua</option>
              <option value="Panitera">Panitera</option>
              <option value="Sekretaris">Sekretaris</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
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
    $('#tabel').DataTable({
      dom: 'Bfrtip',
      buttons: [
        'copy', 'excel', 'pdf'
      ]
    })
  });
</script>

@endsection
