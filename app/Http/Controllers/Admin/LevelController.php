<?php

namespace App\Http\Controllers\Admin;

use App\Level;
use App\Log;
use Auth;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response, Redirect;

class LevelController extends Controller
{
    public function index()
    {
        $data = Level::all();
        $back = Helper::back_button();
			  $tombol = Helper::rekam('Tambah Level');
        return view('settings/referensi/level/index', compact('data','back','tombol'));
    }

    public function store(Request $request)
    {
      $request->validate(['nama_level' => 'required|unique:tb_level'], 
        ['nama_level.required' => 'Nama Level Wajib diisi',
        'nama_level.unique' => 'Nama Level Sudah Ada'
        ]);

      Level::create(['nama_level' => $request->nama_level]);  
      Log::create([
			'user_id' => Auth::user()->id,
			'pesan_Log' => 'Mengedit Level'
      ]);
      return Redirect::back()->with('message', 'Data Level Berhasil ditambahkan');
    }

    public function edit(Level $level)
    {
      return view('settings/referensi/level/edit', compact('level'));
    }

    public function update(Request $request, Level $level)
    {
      $request->validate(['nama_level' => 'required|unique:tb_level'], 
        ['nama_level.required' => 'Nama Level Wajib diisi',
        'nama_level.unique' => 'Nama Level Sudah Ada'
        ]);

      $level->update(['nama_level' => $request->nama_level]);
      return redirect('/settings/referensi/level')->with('message', 'Data Level Berhasil dirubah');    
    }

    public function destroy(Level $level)
    {
        //
    }
}
