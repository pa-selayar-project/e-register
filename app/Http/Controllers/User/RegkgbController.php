<?php

namespace App\Http\Controllers\User;

use App\Regkgb;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response, Redirect;

class RegkgbController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Regkgb::all();
        return view('register/kgb/index', ['data' => $data]);
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
     * @param  \App\Regkgb  $regkgb
     * @return \Illuminate\Http\Response
     */
    public function show(Regkgb $regkgb)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Regkgb  $regkgb
     * @return \Illuminate\Http\Response
     */
    public function edit(Regkgb $regkgb)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Regkgb  $regkgb
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Regkgb $regkgb)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Regkgb  $regkgb
     * @return \Illuminate\Http\Response
     */
    public function destroy(Regkgb $regkgb)
    {
        //
    }
}
