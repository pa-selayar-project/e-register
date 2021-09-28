<?php

namespace App\Http\Controllers\Admin;

use App\Pegawai;
use App\Log;
use Auth;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response, Redirect;

class KpaController extends Controller
{
	public function index()
	{
		$back = Helper::back_button();
		$tombol = Helper::rekam('edit KPA');
		$data = Pegawai::whereKpa(1)->first();
		$select = Pegawai::whereStatus(1)->whereAktif(1)->orderBy('jabatan_id','asc')->get();

		return view('settings/referensi/kpa/index', compact('back','data','tombol','select'));
	}

	public function update(Request $request, $id)
	{
			$lama = Pegawai::whereKpa(1)->first();
			$lama->update(['kpa'=>0]);

			$baru = Pegawai::findOrFail($id);
			$baru->update(['kpa'=>1]);

			return Redirect::back()->with('message', 'Data KPA Berhasil diupdate');
	}
}
