<?php

namespace App\Http\Controllers\Admin;

use App\Headmenu;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response, Redirect;

class HeadmenuController extends Controller
{
    public function index()
    {
        $data = Headmenu::all();
        return view('settings/headmenu/index', ['data' => $data]);
    }

    public function store(Request $request)
    {
        $insert = Headmenu::create($this->validateRequest('create'));
        Response::json($insert);
        return Redirect::back()->with('message', 'Data Head Menu Berhasil ditambahkan');
    }


    public function update(Request $request, Headmenu $headmenu)
    {
        $headmenu->update($this->validateRequest('update'));
        Response::json($headmenu);
        return Redirect::back()->with('message', 'Data Head Menu Berhasil dirubah');
    }

    public function destroy(Headmenu $headmenu)
    {
        //
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
        } else {
            $rule = 'required';
        }

        return request()->validate([
            'nama_head' => $rule,
            'place' => 'required'
        ], $messages);
    }
}
