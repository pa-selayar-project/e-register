<?php

namespace App\Http\Controllers\User;

use Auth;
use App\Pegawai;
use App\Honorer;
use App\Regsk;
use App\Regstugas;
use App\Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
	public function index()
	{
		$pegawai = Pegawai::whereStatus(1)->count();
		$honorer = Pegawai::whereStatus(2)->count();
		$sk = Regsk::whereTahun(date('Y'))->count();
		$st = Regstugas::whereTahun(date('Y'))->count();

		$awaltahun = strtotime(date('01-01-Y'));
		$akhirtahun = strtotime(date('31-12-Y'));

		$notif = Pegawai::whereStatus(1)->whereAktif(1)
			->where('kgb_yad', '>', $awaltahun)
			->where('kgb_yad', '<', $akhirtahun)
			->orWhere('kp_yad', '>', $awaltahun)
			->where('kp_yad', '<', $akhirtahun)
			->limit(10)
			->get();
		$hitungnotif = $notif->count();

		if (Auth::user()->id_level == 1) {
			$logs = Log::limit(5)->orderBy('id', 'desc')->get();
			$hitunglog = Log::all()->count();
		} else {
			$logs = Log::where('user_id', Auth::user()->id)->limit(5)->orderBy('id', 'desc')->get();
			$hitunglog = Log::where('user_id', Auth::user()->id)->count();
		}
		
		return view('dashboard/index', compact('pegawai', 'honorer', 'sk', 'st', 'notif', 'hitungnotif', 'logs', 'hitunglog'));
	}

	public function pegawai()
	{
		$data = Pegawai::whereStatus(1)->orderBy('jabatan_id')->get();
		return view('dashboard/pegawai', ['data' => $data]);
	}

	public function pegawai_nonaktif()
	{
		$data = Pegawai::onlyTrashed()->orderBy('jabatan_id')->get();
		return view('dashboard/pegawai_nonaktif', ['data' => $data]);
	}

	public function honorer()
	{
		$data = Honorer::whereStatus(2)->get();
		return view('dashboard/honorer', ['data' => $data]);
	}

	public function daftarsk($id)
	{
		$pgw = Pegawai::withTrashed()->findOrFail($id);
		$data = Regsk::where('obyek','LIKE', '%'.$pgw->nip.'%')->whereTahun(date('Y'))->get();
		
		return view('dashboard/daftarsk', compact('data','pgw'));
	}
}
