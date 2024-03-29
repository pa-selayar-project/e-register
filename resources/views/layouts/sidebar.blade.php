<aside id="left-panel" class="left-panel">
  <nav class="navbar navbar-expand-sm navbar-default">
    <div class="navbar-header">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fa fa-bars"></i>
      </button>

      <a class="navbar-brand mt-0" href="{{url('/dashboard')}}"><img src="{{url('assets/images/logo/'.$setting->logo_kecil)}}" height="60" width="60" alt="Logo">{{$setting->nama_aplikasi}}</a>
      <a class="navbar-brand hidden" href="{{url('/dashboard')}}"><img src="{{url('assets/images/logo/'.$setting->logo_kecil)}}" height="60" width="60"></a>
    </div>

    <div id="main-menu" class="main-menu collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li class="active">
          <a href="{{url('dashboard')}}"> <i class="menu-icon fa fa-book"></i>Dashboard </a>
        </li>

        <?php 
        $head = App\Headmenu::wherePlace(2)->whereLevel(Auth::user()->id_level)->get();
        ?>
        @foreach($head as $h)
        <h3 class="menu-title">{{$h->nama_head}}</h3><!-- /.menu-title -->
        
        <?php $menu = App\Menu::where('headmenu_id', $h->id)->get();?>
        
        @foreach($menu as $m)
        <li>
          <a href="{{url($m->link)}}"><i class="menu-icon {{$m->icon}}"></i>{{$m->nama_menu}}</a>
        </li>
        @endforeach

        @endforeach
      
      </ul>
    </div><!-- /.navbar-collapse -->
  </nav>
</aside><!-- /#left-panel -->