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
		if (Auth::user()->id_level == 1) {
			$data = Log::orderBy('id', 'desc')->get();
		} else {
			$data = Log::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
		}

    return view('log/index', compact('data'));
  }

  public function destroy($id)
  {
    Log::destroy($id);
    return Redirect::back()->withSuccess('Data berhasil dihapus!');
    }
}
