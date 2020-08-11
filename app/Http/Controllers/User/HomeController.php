<?php

namespace App\Http\Controllers\User;

use Auth;
use \App\Pegawai;
use \App\Honorer;
use \App\Regsk;
use \App\Regstugas;
use \App\Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
	public function index()
	{
		$pegawai = Pegawai::where('status', 1)->where('aktif', 1)->count();
		$honorer = Pegawai::where('status', 2)->count();
		$sk = Regsk::where('deleted_at', null)->count();
		$st = Regstugas::where('deleted_at', null)->count();

		$awaltahun = strtotime(date('01-01-Y'));
		$akhirtahun = strtotime(date('31-12-Y'));

		$notif = Pegawai::where('status', 1)->where('aktif', 1)
			->where('kgb_yad', '>', $awaltahun)
			->where('kgb_yad', '<', $akhirtahun)
			->orWhere('kp_yad', '>', $awaltahun)
			->where('kp_yad', '<', $akhirtahun)
			->limit(4)
			->get();
		$hitungnotif = $notif->count();

		if (Auth::user()->level == 1) {
			$logs = Log::limit(6)->orderBy('id', 'desc')->get();
			$hitunglog = Log::all()->count();
		} else {
			$logs = Log::where('user_id', Auth::user()->id)->limit(6)->orderBy('id', 'desc')->get();
			$hitunglog = Log::where('user_id', Auth::user()->id)->count();
		}

		return view('dashboard/index', compact('pegawai', 'honorer', 'sk', 'st', 'notif', 'hitungnotif', 'logs', 'hitunglog'));
	}

	public function pegawai()
	{
		$data = Pegawai::where('status', 1)->where('aktif', 1)->whereNull('deleted_at')->orderBy('jabatan_id')->get();
		return view('dashboard/pegawai', ['data' => $data]);
	}

	public function honorer()
	{
		$data = Honorer::where('status', 2)->whereNull('deleted_at')->get();
		return view('dashboard/honorer', ['data' => $data]);
	}

	public function daftarsk($id)
	{
			$data = Regsk::where('obyek','like','%'.$id.'%')->paginate(5);
			$pgw = Pegawai::where('id', $id)->first();
			return view('dashboard/daftarsk', compact('data','pgw'));
	}
}
