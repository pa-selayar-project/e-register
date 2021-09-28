<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Referensi;
use App\Log;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Auth, Response, Redirect;

class ReferensiController extends Controller
{
    public function index()
    {
        $data = Referensi::all();
        $tombol = Helper::rekam('Tambah Referensi'); 
        $back = Helper::back_button();
        return view('settings/referensi/index', compact('back','data','tombol'));
    }

    public function store(Referensi $referensi)
    {
        $insert = Referensi::create($this->validateRequest('create'));
        Response::json($insert);

        Log::create([
            'user_id' => Auth::user()->id,
            'pesan_Log' => 'Menambahkan Referensi Baru'
        ]);

        return Redirect::back()->with('message', 'Data Referensi Berhasil ditambahkan');
    }

    public function update(Referensi $referensi)
    {
        $referensi->update($this->validateRequest('update'));
        Response::json($referensi);

        Log::create([
            'user_id' => Auth::user()->id,
            'pesan_Log' => 'Mengedit Referensi'
        ]);

        return Redirect::back()->with('message', 'Data Referensi Berhasil dirubah');
    }

    public function destroy(Referensi $referensi)
    {
        
    }

    public function get_data($id)
	{
        $data = Referensi::findOrFail($id);
		return $data;
	}

    private function validateRequest($type)
    {
        $messages = [
            'required' => 'Kolom :attribute Wajib Diisi!',
            'unique' => 'Data :attribute Sudah Ada Dalam Database'
        ];

        if ($type == 'create') {
            $rule = 'required|unique:tb_referensi';
        } else {
            $rule = 'required';
        }

        return request()->validate([
            'nama_referensi' => $rule,
            'icon' => 'required',
            'link' => 'required'
        ], $messages);
    }
}
