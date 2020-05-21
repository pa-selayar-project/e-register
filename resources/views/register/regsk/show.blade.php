@extends('layouts.app')

@section('title','Detail SK')

@section('breadcumb')
<a href="javascript:history.back();" class="d-none d-sm-inline-block btn btn-sm btn-primary btn-icon-split rounded mr-1">
  <span class="icon text-white-50">
    <i class="fa fa-chevron-circle-left"></i>
  </span>
</a>
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
          <td style="width:25%">Nomor</td>
          <td style="width:75%">{{$regsk->no_sk}}</td>
        </tr>
        <tr>
          <td>Tanggal</td>
          <td>{{\App\Helpers\Helper::tanggal_id($regsk->tgl_sk)}}</td>
        </tr>
        <tr>
          <td>Perihal</td>
          <td>{{$regsk->desc_sk}}</td>
        </tr>
        <tr>
          <td>Obyek SK</td>
          <td>
          @if(collect($obyek)->count()==0)
            Tidak Ada
          @else
            @foreach($obyek as $oby)
              {{$oby->nama_pegawai}}<br>
            @endforeach
          @endif
          </td>
        </tr>
        <tr>
          <td>Files</td>
          <td>
            @if($regsk->word)
            <a href="{{url('assets/word/'.$regsk->word)}}" class="mr-5"><i class="fas fa-file-word text-primary"></i> Download File Word</a>
            @else
            <i class="fas fa-file-word text-secondary"></i> Tidak ada file
            @endif

            @if($regsk->pdf)
            <a href="{{url('assets/pdf/'.$regsk->pdf)}}" class="ml-5" target="_blank"><i class="fas fa-file-pdf text-danger"></i> Download File PDF</a>
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