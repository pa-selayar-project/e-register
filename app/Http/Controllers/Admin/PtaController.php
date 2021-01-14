<?php

namespace App\Http\Controllers\Admin;

use App\Pta;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response, Redirect;

class PtaController extends Controller
{
  public function index()
  {
    $data = Pta::all();
        
    return view('settings/pta/index', ['data' => $data]);
  }
   
  public function store(Request $request)
  {
    $messages = [
                'nama_pta.required' => 'Nama PTA Wajib diisi',
                'alamat.required' => 'Alamat Wajib diisi'
                ];
    $request->validate([
    	'nama_pta' => 'required',
      'alamat' => 'required'
    ], $messages);

    Pta::create([
    	'nama_pta' => $request->nama_pta,
      'alamat' => $request->alamat
    ]);

    return redirect('/settings/pta/index')->with('message', 'Input PTA berhasil');
  }

  public function update(Request $request, Pta $pta)
  {
        //
  }

  public function destroy(Pta $pta)
  {
       //
  }
}
