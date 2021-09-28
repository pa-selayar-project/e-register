<?php

namespace App\Http\Controllers\Admin;

use App\Pegawai;
use App\Log;
use Auth;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response, Redirect;

class PpkController extends Controller
{
	public function index()
	{
		$back = Helper::back_button();
		$tombol = Helper::rekam('edit PPK');
		$data = Pegawai::wherePpk(1)->first();
		$select = Pegawai::whereStatus(1)->whereAktif(1)->orderBy('jabatan_id','asc')->get();

		return view('settings/referensi/ppk/index', compact('back','data','tombol','select'));
	}

	public function update(Request $request, $id)
	{
			$lama = Pegawai::wherePpk(1)->first();
			$lama->update(['ppk'=>0]);

			$baru = Pegawai::findOrFail($id);
			$baru->update(['ppk'=>1]);

			return Redirect::back()->with('message', 'Data PPK Berhasil diupdate');
	}
}
