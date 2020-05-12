<?php

namespace App\Http\Controllers\User;

use App\Regcuti;
use App\Pegawai;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response, Redirect;

class RegcutiController extends Controller
{
    public function index()
    {
        $data = Regcuti::all();
        return view('register/surat_cuti/index', ['data' => $data]);
    }

    public function create()
    {
        $pegawai = Pegawai::where('status', 1)->get();
        return view('register/surat_cuti/create', compact('pegawai'));
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Regcuti $regcuti)
    {
        //
    }

    public function edit(Regcuti $regcuti)
    {
        //
    }

    public function update(Request $request, Regcuti $regcuti)
    {
        //
    }

    public function destroy(Regcuti $regcuti)
    {
        //
    }
}
