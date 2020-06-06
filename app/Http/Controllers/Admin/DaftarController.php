<?php

namespace App\Http\Controllers\Admin;

use App\Daftar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response, Redirect;

class DaftarController extends Controller
{
    
	public function index()
	{
			$users = Daftar::all();

			return view('daftar/index', compact('users'));
	}

	public function create()
	{
			//
	}

  public function store(Request $request)
	{
			//
	}

	public function show(Daftar $daftar)
	{
			//
	}

	public function edit(Daftar $daftar)
	{
			//
	}

	public function update(Request $request, Daftar $daftar)
	{
			//
	}

	public function destroy(Daftar $daftar)
	{
			//
	}
}
