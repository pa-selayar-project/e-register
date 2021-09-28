<?php

namespace App\Http\Controllers\Admin;

use App\Pta;
use App\Log;
use App\Helpers\Helper;
use Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response, Redirect;

class PtaController extends Controller
{
  public function index()
  {
    $data = Pta::all();
    $back = Helper::back_button();    
    $tombol = Helper::rekam('Tambah PTA');    
    return view('settings/referensi/pta/index', compact('data','back','tombol'));
  }
   
  public function store(Request $request)
  {
    $insert = Pta::create($this->validateRequest('create'));
		Response::json($insert);
    
		Log::create([
			'user_id' => Auth::user()->id,
			'pesan_Log' => 'Menginput Data PTA'
		]);

    return Redirect::back()->with('message', 'Input Data PTA berhasil');
  }

  public function update($id)
  {
    $pta = Pta::findOrFail($id)->update($this->validateRequest('update'));
		Response::json($pta);

		Log::create([
			'user_id' => Auth::user()->id,
			'pesan_Log' => 'Mengedit Data PTA'
		]);

		return Redirect::back()->with('message', 'Data PTA Berhasil dirubah');
  }

  public function destroy(Pta $pta,$id)
  {
    Pta::destroy($id);
		Log::create([
			'user_id' => Auth::user()->id,
			'pesan_Log' => 'Menghapus Data PTA'
		]);
		return Redirect::back()->with('message', 'Data PTA Berhasil dihapus');
  }

	public function get_data($id)
	{
		$data = Pta::findOrFail($id);
		return $data;
	}

  private function validateRequest($type)
	{
		$messages = [
			'required' => 'Kolom :attribute Wajib Diisi!',
			'unique' => 'Data :attribute Sudah Ada Dalam Database'
		];

		if ($type == 'create') {
			$rule = 'required|unique:tb_pta';
		} else {
			$rule = 'required';
		}

		return request()->validate([
			'nama_pta' => $rule,
      'alamat' => 'required',
      'ketua' => 'required',
      'nip' => 'required'
		], $messages);
	}
}
