@extends('layouts.app')

@section('title','Detail SK')

@section('content')
<div class="card shadow mb-4">
  <div class="card-body">
    <div class="table-responsive-xl">
      <table class="table table-striped table-bordered" style="width:100%">
        <tr>
          <th class="p-5 text-center text-uppercase" colspan="3">data surat keputusan</th>
        </tr>
        <tr>
          <td style="width:20%">Nomor</td>
          <td style="width:5%">:</td>
          <td style="width:75%">{{$regsk->no_sk}}</td>
        </tr>
        <tr>
          <td>Tanggal</td>
          <td>:</td>
          <td>{{date('d M Y', $regsk->tgl_sk)}}</td>
        </tr>
        <tr>
          <td>Perihal</td>
          <td>:</td>
          <td>{{$regsk->desc_sk}}</td>
        </tr>
        <tr>
          <td>Obyek SK</td>
          <td>:</td>
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
          <td>:</td>
          <td>
            @if($regsk->word)
            <a href="{{url('assets/word/'.$regsk->word)}}" class="mr-5"><i class="fas fa-file-word text-primary"></i> Download File Word</a>
            @else
            <i class="fas fa-file-word text-secondary"></i> Tidak ada file
            @endif

            @if($regsk->pdf)
            <a href="{{url('assets/pdf/'.$regsk->pdf)}}" class="ml-5"><i class="fas fa-file-pdf text-danger"></i> Download File PDF</a>
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