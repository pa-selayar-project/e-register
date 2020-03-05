<?php

namespace App\Http\Controllers\Admin;

use App\Menu;
use App\Headmenu;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response, Redirect;

class MenuController extends Controller
{

    public function index()
    {
        $data = Menu::all();
        $head = Headmenu::all();
        return view('settings/menu/index', ['data' => $data, 'head' => $head]);
    }

    public function store(Request $request)
    {
        $insert = Menu::create($this->validateRequest('create'));
        Response::json($insert);
        return Redirect::back()->with('message', 'Data Menu Berhasil ditambahkan');
    }

    public function update(Request $request, Menu $menu)
    {
        $menu->update($this->validateRequest('update'));
        Response::json($menu);
        return Redirect::back()->with('message', 'Data Menu Berhasil dirubah');
    }

    public function destroy(Menu $menu)
    {
        //
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
