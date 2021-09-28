@extends('layouts.app')

@section('title','Register Kenaikan Gaji Berkala')

@section('tombol')
<a href="{{url('register/kgb/create')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary btn-icon-split">
  <span class="icon text-white-50">
    <i class="fas fa-plus"></i>
  </span>
  <span class="text"> Tambah</span>
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
            <th style="width:25%">Nomor/Tgl KGB</th>
            <th style="width:25%">Nama Pegawai</th>
            <th style="width:15%">TMT</th>
            <th style="width:15%">TMT YAD</th>
            <th style="width:15%">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($data as $d)
          <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$d->no_kgb}} <br> 
              Tgl. {{\App\Helpers\Helper::tanggal_id($d->tgl_kgb)}}
            </td>
            <td>{{$d->pegawai->nama_pegawai}}</td>
            <td>{{\App\Helpers\Helper::tanggal_id($d->tmt_kgb)}}</td>
            <td>{{\App\Helpers\Helper::tanggal_id($d->tmt_yad)}}</td>
            <td class="d-flex">
              @if(Auth::user()->id_level == 2)
              <form action="/register/kgb/{{$d->id}}" method="post" id="delete{{$d->id}}">
                @csrf
                @method('delete')
              </form>
              <a href="#" class="btn btn-danger btn-sm btn-circle rounded swalConfirm" data-id="{{$d->id}}"><i class="fa fa-trash"></i></a>

              <a href="{{url('register/kgb/'.$d->id.'/edit')}}" class="btn btn-success btn-sm btn-circle rounded mx-1"><i class="fa fa-edit"></i></a>
              @endif
              <a href="{{url('register/kgb/'.$d->id)}}" class="btn btn-primary btn-sm btn-circle rounded"><i class="fa fa-folder-open"></i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
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
    });

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
          $('#delete'+id).submit();
        }
      })
    });
  });
</script>
@endsection
