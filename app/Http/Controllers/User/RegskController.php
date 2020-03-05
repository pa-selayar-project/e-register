<?php

namespace App\Http\Controllers\User;

use App\Regsk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response, Redirect;

class RegskController extends Controller
{
    public function index()
    {
        $data = Regsk::all();
        return view('register/regsk/index', ['data' => $data]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_sk' => 'required|unique:reg_sk',
            'no_sk' => 'required|unique:reg_sk',
            'desc_sk' => '-',
            'tgl_sk' => 'required|date',
            'bidang_sk' => 'required',
            'ttd_sk' => 'required'
        ]);
        
        Regsk::create([
            'nama_sk' => $request->nama_sk,
            'no_sk' => $request->no_sk,
            'desc_sk' => '-',
            'tgl_sk' => strtotime($request->tgl_sk),
            'bidang_sk' => $request->bidang_sk,
            'ttd_sk' => $request->ttd_sk,
            'tahun' => date('Y'),
        ]);
        return redirect('/register/regsk')->with('message', 'Input data berhasil');
    }

    public function show(Regsk $regsk)
    {
        return view('register/regsk/show', compact('regsk'));;
    }

    public function edit(Regsk $regsk)
    {
        return view('register/regsk/edit', compact('regsk'));
    }

    public function update(Request $request, Regsk $regsk)
    {
        return $regsk->no_sk;
    }

    public function destroy(Regsk $regsk)
    {
        //
    }
}
