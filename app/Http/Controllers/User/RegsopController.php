<?php

namespace App\Http\Controllers\User;

use App\Regsop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response, Redirect;

class RegsopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Regsop::all();
        return view('register/sop/index', ['data' => $data]);
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
     * @param  \App\Regsop  $regsop
     * @return \Illuminate\Http\Response
     */
    public function show(Regsop $regsop)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Regsop  $regsop
     * @return \Illuminate\Http\Response
     */
    public function edit(Regsop $regsop)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Regsop  $regsop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Regsop $regsop)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Regsop  $regsop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Regsop $regsop)
    {
        //
    }
}
