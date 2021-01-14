<?php

namespace App\Http\Controllers\Admin;

use App\Pejabat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response, Redirect;

class PejabatController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Pejabat $pejabat)
    {
        //
    }

    public function edit(Pejabat $pejabat)
    {
        //
    }

    public function update(Request $request, Pejabat $pejabat)
    {
			dd($request);
      $messages = [
                'ketua.required' => 'Kolom Ketua Wajib diisi',
                'wakil_ketua.required' => 'Kolom Wakil Ketua Wajib diisi',
                'plh_ketua.required' => 'Plh Ketua Wajib diisi'
                ];
			$valid = $request->validate([
				'ketua' => 'required',
				'wakil_ketua' => 'required',
				'plh_ketua' => 'required'
			], $messages);

			$update = Pejabat::find(1)->update($valid);
			Response::json($update);

			return redirect('settings/satker/index')->with('message', 'Edit Pejabat PTA berhasil');
    }
}
