<?php

namespace App\Http\Controllers\Admin;

use App\Menu;
use App\Log;
use App\Headmenu;
use App\Helpers\Helper;
use Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response, Redirect;

class MenuController extends Controller
{

    public function index()
    {
        $data = Menu::paginate(10);
        $head = Headmenu::all();
        $back = Helper::back_button();
        $tombol = Helper::rekam('Tambah Data');
        return view('settings/menu/index', compact('data','head','back','tombol'));
    }

    public function store(Request $request)
    {
        $insert = Menu::create($this->validateRequest('create'));
        Response::json($insert);

        Log::create([
            'user_id' => Auth::user()->id,
            'pesan_Log' => 'Menambahkan Menu Baru'
        ]);

        return Redirect::back()->with('message', 'Data Menu Berhasil ditambahkan');
    }

    public function update(Request $request, Menu $menu)
    {
        $menu->update($this->validateRequest('update'));
        Response::json($menu);

        Log::create([
            'user_id' => Auth::user()->id,
            'pesan_Log' => 'Mengedit Menu'
        ]);

        return Redirect::back()->with('message', 'Data Menu Berhasil dirubah');
    }

    public function destroy($id)
    {
        Menu::destroy($id);
        Log::create([
            'user_id' => Auth::user()->id,
            'pesan_Log' => 'Menghapus Data Menu'
        ]);
        return Redirect::back()->with('message', 'Data Menu Berhasil dihapus');
    }

    private function validateRequest($type)
    {
        $messages = [
            'required' => 'Kolom :attribute Wajib Diisi!',
            'unique' => 'Data :attribute Sudah Ada Dalam Database'
        ];

        if ($type == 'create') {
            $rule = 'required|unique:tb_menu';
        } else {
            $rule = 'required';
        }

        return request()->validate([
            'nama_menu' => $rule,
            'headmenu_id' => 'required',
            'link' => 'required',
            'icon' => 'required'
        ], $messages);
    }
}
