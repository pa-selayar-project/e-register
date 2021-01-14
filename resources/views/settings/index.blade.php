@extends('layouts.app')

@section('title','Setting')

@section('content')
<div class="card shadow mb-4">
  <div class="card-body">
    <div class="row d-flex p-2 justify-content-around">
      <div class="mx-5 my-3 p-2">
        <a href="{{url('settings/parent_menu')}}">
          <i class="fas fa-bars fa-8x"></i>
          <div class="text-center text-primary">Head Menu</div>
        </a>
      </div>
      <div class="mx-5 my-3 p-2">
        <a href="{{url('settings/menu')}}">
          <i class="fas fa-chevron-circle-down fa-8x"></i>
          <div class="text-center text-primary">Menu</div>
        </a>
      </div>
      <div class="mx-5 my-3 p-2">
        <a href="{{url('settings/pegawai')}}">
          <i class="fas fa-users fa-8x"></i>
          <div class="text-center text-primary">Pegawai</div>
        </a>
      </div>
      <div class="mx-5 my-3 p-2">
        <a href="{{url('settings/pramubhakti')}}">
          <i class="fas fa-user-friends fa-8x"></i>
          <div class="text-center text-primary">Pramubhakti</div>
        </a>
      </div>
      <div class="mx-5 my-3 p-2">
        <a href="{{url('settings/satker')}}">
          <i class="fas fa-building fa-8x"></i>
          <div class="text-center text-primary">Info Satker</div>
        </a>
      </div>
      <div class="mx-5 my-3 p-2">
        <a href="#">
          <i class="fas fa-clipboard-list fa-8x"></i>
          <div class="text-center text-primary">Attribut</div>
        </a>
      </div>
      <div class="mx-5 my-3 p-2">
        <a href="{{url('settings/setting')}}">
          <i class="fas fa-cogs fa-8x"></i>
          <div class="text-center text-primary">Setting</div>
        </a>
      </div>
      <div class="mx-5 my-3 p-2">
        <a href="{{url('settings/database')}}">
          <i class="fas fa-database fa-8x"></i>
          <div class="text-center text-primary">Database</div>
        </a>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
  <script type="text/javascript">
    $(document).ready(function(){
      $('#addData').remove();
    });
  </script>
@endsection


