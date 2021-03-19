<?php

namespace App\Http\Controllers\Admin;

use App\Satker;
use App\Pta;
use App\Pejabat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response, Redirect;

class SatkerController extends Controller
{
  public function index()
  {
    $pta = Pta::findOrFail(1);
    $pejabat = Pejabat::findOrFail(1);

    return view('settings/satker/index', compact('pta','pejabat'));
  }
  
  public function store(Request $request)
  {
		dd($request->nama_pta);	
  }


  public function show(Satker $satker)
  {
        //
  }

  public function edit(Satker $satker)
  {
        //
  }

  public function update(Request $request, Satker $satker)
    {
        //
    }

    public function destroy(Satker $satker)
    {
        //
		}
		
		private function validasiRequest()
		{
			$messages = [
				'nama_pta'=>'required|unique:nama_pta'
			];
		}
}
