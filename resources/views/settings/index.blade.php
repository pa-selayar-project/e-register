@extends('layouts.app')

@section('title','Settings')

@section('content')
<div class="card shadow mb-4">
  <div class="card-body">
    <div class="row p-2">
      <!-- Menu Manager -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Menu Manager</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  <a href="{{url('settings/parent_menu')}}">Head Menu</a>
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                   <a href="{{url('settings/menu')}}">Menu</a>
                </div>
              </div>
              <div class="col-auto">
                <i class="fa fa-list fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Personalia -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Personalia</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  <a href="{{url('settings/pegawai')}}" class="text-success">Pegawai</a>
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  <a href="{{url('settings/honorer')}}" class="text-success">Honorer</a>
                </div>
              </div>
              <div class="col-auto">
                <i class="fa fa-users fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Satker -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-1">
                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Data Satker</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  <a href="" class="text-info">Info Satker</a>
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  <a href="" class="text-info">Atribut</a>
                </div>
              </div>
              <div class="col-auto">
                <i class="fa fa-clipboard-list fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Aplikasi -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Aplikasi</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  <a href="" class="text-warning">Setting</a>
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  <a href="" class="text-warning">Database</a>
                </div>
              </div>
              <div class="col-auto">
                <i class="fa fa-database fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
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


