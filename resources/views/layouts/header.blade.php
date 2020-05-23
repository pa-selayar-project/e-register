<header id="header" class="header">
	<div class="header-menu">
			<div class="col-sm-7 ">
					<a id="menuToggle" class="menutoggle pull-left float-left"><i class="fa fa-align-justify"></i></a>
					<div class="header-left text-secondary mt-1">
					Aplikasi {{\App\Setting::where('id',1)->first()->nama_aplikasi}} Versi {{\App\Setting::where('id',1)->first()->versi}}
					</div>
			</div>

			<div class="col-sm-5">
					<div class="user-area dropdown float-right">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<img class="user-avatar rounded-circle" src="/assets/pic/{{Auth::user()->image}}" height="30" width="30">
							</a>
							<?php $topmenu = App\Menu::where('headmenu_id', 3)->get();?>
							<div class="user-menu dropdown-menu">
								@foreach($topmenu as $tm)
									<a class="nav-link" href="{{$tm->link}}"><i class="{{$tm->icon}}"></i> {{$tm->nama_menu}}</a>
								@endforeach
									<form method="POST" action="{{url('logout')}}">
											@csrf
											<button class="nav-link border-0 bg-white"><i class="fa fa-power-off"></i> Logout</button>
									</form>
							</div>
					</div>
			</div>
	</div>

</header><!-- /header -->