<?php

namespace App\Http\Controllers\User;

use App\Regstugas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response, Redirect;

class RegstugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Regstugas::all();
        return view('register/surat_tugas/index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Regstugas  $regstugas
     * @return \Illuminate\Http\Response
     */
    public function show(Regstugas $regstugas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Regstugas  $regstugas
     * @return \Illuminate\Http\Response
     */
    public function edit(Regstugas $regstugas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Regstugas  $regstugas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Regstugas $regstugas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Regstugas  $regstugas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Regstugas $regstugas)
    {
        //
    }
}
