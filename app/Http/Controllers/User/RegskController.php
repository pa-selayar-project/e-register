<?php

namespace App\Http\Controllers\User;

use App\Regsk;
use App\Pegawai;
use Auth;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Response, Redirect;

class RegskController extends Controller
{
    public function index()
    {
        $data = Regsk::all();
        return view('register/regsk/index', ['data' => $data]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_sk' => 'required|unique:reg_sk',
            'no_sk' => 'required|unique:reg_sk',
            'tgl_sk' => 'required|date',
            'bidang_sk' => 'required',
            'ttd_sk' => 'required'
        ]);

        if ($validator->fails()) {
        return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }
        
        Regsk::create([
            'nama_sk' => $request->nama_sk,
            'no_sk' => $request->no_sk,
            'desc_sk' => '-',
            'tgl_sk' => strtotime($request->tgl_sk),
            'bidang_sk' => $request->bidang_sk,
            'ttd_sk' => $request->ttd_sk,
            'tahun' => date('Y'),
            'created_at' => date_format(date_create(),'Y-m-d H:i:s'),
        ]);
        return redirect('/register/regsk')->with('message', 'Input data berhasil');
    }

    public function show(Regsk $regsk)
    {
        return view('register/regsk/show', compact('regsk'));;
    }

    public function edit(Regsk $regsk)
    {
        $pegawai = Pegawai::all();
        return view('register/regsk/edit', compact('regsk', 'pegawai'));
    }

    public function update(Request $request, Regsk $regsk)
    {
        $validator = Validator::make($request->all(), [
            'no_sk' => 'required',
            'nama_sk' => 'required',
            'desc_sk' => 'required',
            'tgl_sk' => 'required',
            'bidang_sk' => 'required',
            'ttd_sk' => 'required',
            'obyek' => 'nullable',
            'word' => 'file|nullable|max:1000|mimes:doc,docx',
            'pdf' => 'file|nullable|max:3000|mimes:pdf',
        ]);

        if ($validator->fails()) {
        return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
    }

        $update = Regsk::where('id', $regsk->id);

        if($request->obyek!=""){
            $obyek = implode(',', $request->obyek);
        }
        else
        {
            $obyek = $request->obyek;
        }
        $update->update([
            'no_sk' => $request->no_sk,
            'nama_sk' => $request->nama_sk,
            'desc_sk' => $request->desc_sk,
            'tgl_sk' => strtotime($request->tgl_sk),
            'bidang_sk' => $request->bidang_sk,
            'ttd_sk' => $request->ttd_sk,
            'obyek' => $obyek,
            'tahun' => date('Y')
            ]);

        if($request->hasFile('word')){
            $file     = $request->file('word');
            $ext      = $file->getClientOriginalExtension();
            $wordname = 'SK_'.uniqid().'.'.$ext;
            $file->storeAs('word', $wordname);
            
            Storage::delete('word/'.$regsk->word);
            $update->update(['word'=> $wordname]);
        }

        if($request->hasFile('pdf')){
            $file     = $request->file('pdf');
            $ext      = $file->getClientOriginalExtension();
            $pdfname = 'SK_'.uniqid().'.'.$ext;
            $file->storeAs('pdf/', $pdfname);
            
            Storage::delete('pdf/'.$regsk->pdf);
            $update->update(['pdf'=> $pdfname]);
        }

        return redirect('/register/regsk')->with('toast_success', 'Data berhasil di edit');
    }

    public function destroy(Regsk $regsk)
    {
        Regsk::destroy($regsk->id);
        return back()->with('toast_success', 'Data berhasil dihapus!');
    }
}
