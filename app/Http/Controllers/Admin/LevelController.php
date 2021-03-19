<?php

namespace App\Http\Controllers\Admin;

use App\Level;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response, Redirect;

class LevelController extends Controller
{
    public function index()
    {
        $data = Level::all();
        return view('settings/level/index', compact('data'));
    }

    public function store(Request $request)
    {
      $request->validate(['nama_level' => 'required|unique:tb_level'], 
        ['nama_level.required' => 'Nama Level Wajib diisi',
        'nama_level.unique' => 'Nama Level Sudah Ada'
        ]);

      Level::create(['nama_level' => $request->nama_level]);  
      
      return Redirect::back()->with('message', 'Data Level Berhasil ditambahkan');
    }

    public function edit(Level $level)
    {
      return view('settings/level/edit', compact('level'));
    }

    public function update(Request $request, Level $level)
    {
      $request->validate(['nama_level' => 'required|unique:tb_level'], 
        ['nama_level.required' => 'Nama Level Wajib diisi',
        'nama_level.unique' => 'Nama Level Sudah Ada'
        ]);

      $level->update(['nama_level' => $request->nama_level]);
      return redirect('/settings/level')->with('message', 'Data Level Berhasil dirubah');    
    }

    public function destroy(Level $level)
    {
        //
    }
}
