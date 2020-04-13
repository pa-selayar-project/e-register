<?php

namespace App\Http\Controllers\Admin;

use App\Pegawai;
use App\Jabatan;
use App\Pangkat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response, Redirect;

class PegawaiController extends Controller
{
    public function index()
    {
        $data = Pegawai::all();
        return view('settings/pegawai/index', ['data' => $data]);
    }

    public function create()
    {
        $jabatan = Jabatan::all();
        $pangkat = Pangkat::all();
        return view('settings/pegawai/create', ['jabatan' => $jabatan, 'pangkat' => $pangkat]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'nip' => 'required|integer|unique:tb_pegawai',
            'pangkat' => 'required',
            'jabatan' => 'required'
        ]);

        Pegawai::create([
            'nama_pegawai' => $request->name,
            'nip' => $request->nip,
            'pangkat_id' => $request->pangkat,
            'jabatan' => $request->jabatan
        ]);

        return redirect('/settings/pegawai')->with('message', 'Input Pegawai berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function show(Pegawai $pegawai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function edit(Pegawai $pegawai)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pegawai $pegawai)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pegawai $pegawai)
    {
        //
    }
}
