<?php

namespace App\Http\Controllers\Admin;

use App\Daftar;
use App\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Response, Redirect;

class DaftarController extends Controller
{
    
	public function index()
	{
			$users = Daftar::all();
			$pgw = Pegawai::orderBy('jabatan_id')->get();
			return view('daftar/index', compact('users','pgw'));
	}

  public function store(Request $request)
	{
			$data = Pegawai::findOrFail($request->pgw);

			Daftar::create([
					'name' => $data->nip,
					'id_pegawai' => $data->id,
          'email' => 'pa.selayar@yahoo.com.',
          'password' => Hash::make('123'),
          'level' => 3,
          'image' => $data->foto
			]);

			return redirect('daftar')->with('message', 'Input User berhasil');
	}

	public function show(Daftar $daftar)
	{
			dd($daftar);
	}

	public function edit(Daftar $daftar)
	{
			dd($daftar);
	}

	public function update(Request $request, Daftar $daftar)
	{
			dd($daftar);
	}

	public function destroy(Daftar $daftar)
	{
			dd($daftar);
	}
}
