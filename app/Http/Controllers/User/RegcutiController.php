<?php

namespace App\Http\Controllers\User;

use App\Regcuti;
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
        return view('register/surat_cuti/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Regcuti  $regcuti
     * @return \Illuminate\Http\Response
     */
    public function show(Regcuti $regcuti)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Regcuti  $regcuti
     * @return \Illuminate\Http\Response
     */
    public function edit(Regcuti $regcuti)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Regcuti  $regcuti
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Regcuti $regcuti)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Regcuti  $regcuti
     * @return \Illuminate\Http\Response
     */
    public function destroy(Regcuti $regcuti)
    {
        //
    }
}
