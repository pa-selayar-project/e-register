<?php

namespace App\Http\Controllers\Admin;

use App\Jabatan;
use App\Log;
use Auth;
use App\Helpers\Helper;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response, Redirect;

class JabatanController extends Controller
{

    public function index()
    {
			$data = Jabatan::paginate(15);
			$back = Helper::back_button();
			$tombol = Helper::rekam('Tambah Jabatan');
			return view('settings/referensi/jabatan/index', compact('data','back','tombol'));
    }

    public function store(Request $request)
    {
			$insert = Jabatan::create($this->validateRequest('create'));
			Response::json($insert);
			
			Log::create([
				'user_id' => Auth::user()->id,
				'pesan_Log' => 'Menginput Data Jabatan'
			]);

			return Redirect::back()->with('message', 'Input Data Jabatan berhasil');
    }

    public function update(Request $request, Jabatan $jabatan)
    {
			$jab = $jabatan->update($this->validateRequest('update'));
			Response::json($jab);

			Log::create([
				'user_id' => Auth::user()->id,
				'pesan_Log' => 'Menginput Data Jabatan'
			]);

			return Redirect::back()->with('message','Data Jabatan berhasil di update');
    }

    public function destroy($id)
    {
      Jabatan::destroy($id);
			Log::create([
				'user_id' => Auth::user()->id,
				'pesan_Log' => 'Menghapus Data Jabatan'
			]);
			return Redirect::back()->with('message', 'Data Jabatan Berhasil dihapus');
    }

		private function validateRequest($type)
		{
			$messages = [
			'required' => 'Kolom :attribute Wajib Diisi!',
			'unique' => 'Data :attribute Sudah Ada Dalam Database'
			];

			if ($type == 'create') {
				$rule = 'required|unique:tb_jabatan';
			} else {
				$rule = 'required';
			}

			return request()->validate([
			'nama_jabatan' => $rule
			], $messages);
		}
}
