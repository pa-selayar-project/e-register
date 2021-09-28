<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
	<?php $setting = \App\Setting::whereId(1)->first();?>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Web Kepegawaian">
  <meta name="author" content="Muhammad Rizaldy Idil">
	<link rel="apple-touch-icon" href="apple-icon.png">
	<link rel="shortcut icon" href="{{url('assets/images/logo/'.$setting->logo_kecil)}}">
	<style>
		#loader{
			position : fixed;
			width : 100%;
			height : 100%;
			z-index : 999;
			background : url({{url('images/loader.gif')}}) 50% no-repeat rgba(255, 255, 255, 0.5);
		}
	</style>

  <title>@yield('title')</title>

    @include('layouts.style')
</head>

<body>
<div id="loader"></div>	
<!-- Left Panel -->

    @include('layouts.sidebar')

<!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        @include('layouts.header')
        <!-- Header-->

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>@yield('title')</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            @yield('breadcumb')
                            @yield('tombol')
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">

            @yield('content')

            @yield('modal')
        </div> <!-- .content -->
    </div><!-- /#right-panel -->

  <!-- Right Panel -->	
  @include('layouts.footer')
  @include('sweetalert::alert')
    <!-- @include('sweetalert::alert') -->
	<script type="text/javascript">
		var $=jQuery.noConflict();
		$(document).ready(function(){
			$("#loader").fadeOut("slow");
		})
        
	</script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>