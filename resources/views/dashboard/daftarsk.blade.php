@extends('layouts.app')

@section('title','Daftar SK')

@section('tombol')
 {!!$back!!}
@endsection

@section('content')
<div class="card shadow mb-4">
  <div class="card-body">
    <div class="table-responsive-xl">
      <table class="table table-striped table-bordered" style="width:100%">
        <tr>
          <th class="p-3 text-center text-uppercase" colspan="6">
          daftar sk<br> 
          {{$pgw->nama_pegawai}}
          </th>
        </tr>
        @foreach($data as $d)
        <tr>
          <td style="width:5%">{{ $loop->iteration }}</td>
          <td style="width:30%">{{$d->no_sk}} <br> 
              Tgl. {{\App\Helpers\Helper::tanggal_id($d->tgl_sk)}}</td>
          <td style="width:30%">{{$d->nama_sk}}</td>
          <td style="width:15%">{{$d->bidang_sk}}</td>
          <td style="width:20%">
            @if($d->pdf)
              <a href="{{url('assets/pdf/'.$d->pdf)}}" class="ml-5" target="_blank"><i class="fas fa-file-pdf text-danger"></i> Download</a>
            @else
              <i class="fas fa-file-pdf text-secondary ml-5"></i> No Data
            @endif
          </td>
        </tr>
        @endforeach
      </table>
      {{$data->links()}}
    </div>
  </div>
</div>
@endsection