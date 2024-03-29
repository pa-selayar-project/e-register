<?php

namespace App\Http\Controllers\Admin;

use App\Headmenu;
use App\Log;
use App\Helpers\Helper;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response, Redirect;

class HeadmenuController extends Controller
{
    public function index()
    {
        $data = Headmenu::all();
        $back = Helper::back_button();
        $tombol = Helper::rekam('Tambah Data');
        return view('settings/headmenu/index', compact('data','tombol','back'));
    }

    public function store(Request $request)
    {
        $insert = Headmenu::create($this->validateRequest('create'));
        Response::json($insert);

        Log::create([
            'user_id' => Auth::user()->id,
            'pesan_Log' => 'Menambahkan Head Menu'
        ]);

        return Redirect::back()->with('message', 'Data Head Menu Berhasil ditambahkan');
    }


    public function update(Request $request, $id)
    {
        $headmenu = Headmenu::findOrFail($id);
        $headmenu->update($this->validateRequest('update'));
        Response::json($headmenu);

        Log::create([
            'user_id' => Auth::user()->id,
            'pesan_Log' => 'Merubah Head Menu'
        ]);

        return Redirect::back()->with('message', 'Data Head Menu Berhasil dirubah');
    }

    public function destroy($id)
    {
        Headmenu::destroy($id);
		Log::create([
			'user_id' => Auth::user()->id,
			'pesan_Log' => 'Menghapus Head Menu'
		]);
		return back()->with('toast_success', 'Data berhasil dihapus!');
    }

    public function settings()
    {
        return view('settings/index');
    }

    private function validateRequest($type)
    {
        $messages = [
            'required' => 'Kolom Ini Wajib Diisi!',
            'unique' => 'Data Ini Sudah Ada Dalam Database'
        ];

        if ($type == 'create') {
            $rule = 'required|unique:tb_head_menu';
        } elseif($type == 'update'){
            $rule = 'required';
        }

        return request()->validate([
            'nama_head' => $rule,
            'place' => 'required'
        ], $messages);
    }
}
