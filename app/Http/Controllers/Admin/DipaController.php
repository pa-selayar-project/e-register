<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Dipa;
use Auth;
use App\Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response, Redirect;

class DipaController extends Controller
{
	public function index()
	{
			$data = Dipa::all();
			$back = Helper::back_button();
			$tombol = Helper::rekam('Tambah Data DIPA');
			return view('settings/referensi/dipa/index', compact('data','back','tombol'));
	}

	public function store(Request $request)
	{
		$insert = Dipa::create($this->validateRequest('create'));
		Response::json($insert);

		Log::create([
				'user_id' => Auth::user()->id,
				'pesan_Log' => 'Menambahkan Data Dipa Baru'
		]);

		return Redirect::back()->with('message', 'Data Dipa Berhasil ditambahkan');
	}

	public function update(Request $request, Dipa $dipa)
	{
		$dipa->update($this->validateRequest('update'));
		Response::json($dipa);

		Log::create([
			'user_id' => Auth::user()->id,
			'pesan_Log' => 'Mengedit Data Dipa'
		]);

		return Redirect::back()->with('message', 'Data Dipa Berhasil dirubah');
	}

	public function destroy($id)
	{
		Dipa::destroy($id);
		Log::create([
			'user_id' => Auth::user()->id,
			'pesan_Log' => 'Mengedit Data Dipa'
		]);

		return Redirect::back()->with('message', 'Data Dipa Berhasil dihapus');
	}

	public function get_data($id)
	{
		$data = Dipa::findOrFail($id);
		$data->tanggal = date('d F Y', $data->tanggal);
		
		return $data;
	}

	private function validateRequest($type)
	{
		$messages = [
			'required' => 'Kolom :attribute Wajib Diisi!',
			'unique' => 'Data :attribute Sudah Ada Dalam Database'
		];

		if ($type == 'create') {
			$rule = 'required|unique:tb_dipa';
		} else {
			$rule = 'required';
		}

		request()->merge(['tanggal'=> strtotime(request()->tanggal)]);
		
		return request()->validate([
			'nomor_dipa' => $rule,
			'tanggal' => 'required',
		], $messages);
	}
}
