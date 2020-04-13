<!DOCTYPE html>
<html class="no-js" lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Web Kepegawaian">
  <meta name="author" content="Muhammad Rizaldy Idil">

  <title>@yield('title')</title>

    @include('layouts.style')

</head>

<body>

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

</body>

</html>