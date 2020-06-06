<?php

namespace App\Http\Controllers\User;

use App\Log;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response, Redirect;

class LogController extends Controller
{
    public function index()
    {
			if (Auth::user()->level == 1) {
			$data = Log::orderBy('id', 'desc')->get();
			} else {
			$data = Log::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
			}

        return view('log/index', compact('data'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Log $log)
    {
        //
    }

    public function edit(Log $log)
    {
        //
    }

    public function update(Request $request, Log $log)
    {
        //
    }

    public function destroy($id)
    {
        Log::destroy($id);
        return back()->with('toast_success', 'Data berhasil dihapus!');
    }
}
