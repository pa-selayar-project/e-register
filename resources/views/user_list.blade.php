@extends('layouts.app')

@section('title','Daftar User')

@section('stylesheet')
<link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet" />
<link href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css" rel="stylesheet" />
@endsection

@section('content')
<div class="row mt-10">
  <div class="col-lg-12">
    <div class="au-card recent-report">
      <div class="au-card-inner">
        <h3 class="title-2"></h3>
        <div class="recent-report__chart">

          <table id="dataUser" class="display" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Foto</th>
                <th>Name</th>
                <th>Email</th>
                <th>Level</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $d)
              <tr>
                <td>{{$loop->iteration}}</td>  
                <td>Foto</td>  
                <td>{{$d->name}}</td>  
                <td>{{$d->email}}</td>  
                <td>{{$d->level}}</td>  
                <td>
                  <a href="#" class="btn btn-danger btn-sm btn-circle hapusData"><i class="fas fa-trash"></i></a>
                  <a href="{{$d->email}}" class="btn btn-success btn-sm btn-circle"><i class="fas fa-edit"></i></a>
                </td>  
              </tr>  
               @endforeach
            </tbody>
          </table>
        </div>
      </div>
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
   $('#dataUser').DataTable({
      dom: 'Bfrtip',
      buttons: [
        'copy', 'excel', 'pdf'
      ]
    });
  });
</script>
@endsection