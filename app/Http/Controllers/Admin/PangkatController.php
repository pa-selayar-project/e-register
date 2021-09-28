<?php

namespace App\Http\Controllers\Admin;

use App\Pangkat;
use App\Log;
use Auth;
use App\Helpers\Helper;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response, Redirect;

class PangkatController extends Controller
{
	public function index()
	{
		$data = Pangkat::paginate(15);
		$back = Helper::back_button();
		$tombol = Helper::rekam('Tambah Data Pangkat');
		return view('settings/referensi/pangkat/index', compact('data','back','tombol'));
	}

	public function store(Request $request)
	{
		$insert = Pangkat::create($this->validateRequest('create'));
			Response::json($insert);
			
			Log::create([
				'user_id' => Auth::user()->id,
				'pesan_Log' => 'Menginput Data Pangkat'
			]);

			return Redirect::back()->with('success', 'Input Data Pangkat berhasil');
	}

	public function update(Request $request, Pangkat $pangkat)
	{
		$pang = $pangkat->update($this->validateRequest('update'));
			Response::json($pang);

			Log::create([
				'user_id' => Auth::user()->id,
				'pesan_Log' => 'Menginput Data Pangkat'
			]);

			return Redirect::back()->with('success','Data Pangkat berhasil di update');
	}

	public function destroy($id)
	{
		Pangkat::destroy($id);
			Log::create([
				'user_id' => Auth::user()->id,
				'pesan_Log' => 'Menghapus Data Pangkat'
			]);
			return Redirect::back()->with('success', 'Data Pangkat Berhasil dihapus');
	}

	private function validateRequest($type)
		{
			$messages = [
			'required' => 'Kolom :attribute Wajib Diisi!',
			'unique' => 'Data :attribute Sudah Ada Dalam Database'
			];

			if ($type == 'create') {
				$rule = 'required|unique:tb_pangkat';
			} else {
				$rule = 'required';
			}

			return request()->validate([
			'nama_pangkat' => $rule,
			'golongan' => 'required'
			], $messages);
		}
}
