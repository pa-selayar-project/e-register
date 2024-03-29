@extends('layouts.app')

@section('title','Detail KGB')

@section('tombol')
  {!!$back!!}
@endsection

@section('content')
<div class="card shadow mb-4">
  <div class="card-body">
    <div class="table-responsive-xl">
      <table class="table table-striped table-bordered" style="width:100%">
        <tr>
          <th class="p-5 text-center text-uppercase" colspan="3">data surat keputusan</th>
        </tr>
        <tr>
          <td style="width:25%">Nama Pegawai</td>
          <td style="width:75%">{{$data->pegawai->nama_pegawai}}</td>
        </tr>
        <tr>
          <td style="width:25%">Nomor</td>
          <td style="width:75%">{{$data->no_kgb}}</td>
        </tr>
        <tr>
          <td>Tanggal</td>
          <td>{{\App\Helpers\Helper::tanggal_id($data->tgl_kgb)}}</td>
        </tr>
        <tr>
          <td>TMT KGB</td>
          <td>{{\App\Helpers\Helper::tanggal_id($data->tmt_kgb)}}</td>
        </tr>
        <tr>
          <td>Template</td>
          <td>
            <form method="post" action="/register/kgb/print/{{$data->id}}">
              @csrf
              <button type="submit" class="btn btn-primary rounded">Print</button>
            </form>
          </td>
        </tr>
        <tr>
          <td>Files</td>
          <td>
            @if($data->word)
            <a href="{{url('assets/word/'.$data->word)}}" class="mr-5"><i class="fas fa-file-word text-primary"></i> Download File Word</a>
            @else
            <i class="fas fa-file-word text-secondary"></i> Tidak ada file
            @endif

            @if($data->pdf)
            <a href="{{url('assets/pdf/'.$data->pdf)}}" class="ml-5" target="_blank"><i class="fas fa-file-pdf text-danger"></i> Download File PDF</a>
            @else
            <i class="fas fa-file-pdf text-secondary ml-5"></i> Tidak ada file
            @endif
          </td>
        </tr>
      </table>
    </div>
  </div>
</div>
@endsection