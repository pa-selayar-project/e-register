<?php

namespace App\Http\Controllers\User;

use App\Regsop;
use App\Log;
use Auth;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Response, Redirect;

class RegsopController extends Controller
{
    public function index()
    {
        $data = Regsop::all();
        return view('register/sop/index', ['data' => $data]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_sop' => 'required|unique:reg_sop',
            'no_sop' => 'required|unique:reg_sop',
            'tgl_sop' => 'required|date',
            'bidang_sop' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }

        Regsop::create([
            'nama_sop' => $request->nama_sop,
            'no_sop' => $request->no_sop,
            'desc_sop' => '-',
            'tgl_sop' => strtotime($request->tgl_sop),
            'bidang_sop' => $request->bidang_sop,
            'tahun' => date('Y'),
        ]);

        Log::create([
            'user_id' => Auth::user()->id,
            'pesan_Log' => 'Menginput SOP'
        ]);

        return redirect('/register/sop')->withToastSuccess('Input data berhasil');
    }

    public function show(Regsop $regsop, $id)
    {
        $data = Regsop::where('id', $id)->get()[0];
        return view('register/sop/show', compact('data'));
    }

    public function edit(Request $request, Regsop $regsop, $id)
    {
        $data = Regsop::where('id', $id)->get()[0];
        return view('register/sop/edit', compact('data'));
    }

    public function update(Request $request, Regsop $regsop, $id)
    {

        $validator = Validator::make($request->all(), [
            'no_sop' => 'required',
            'nama_sop' => 'required',
            'desc_sop' => 'required',
            'tgl_sop' => 'required',
            'bidang_sop' => 'required',
            'word' => 'file|nullable|max:1000|mimes:doc,docx',
            'pdf' => 'file|nullable|max:3000|mimes:pdf',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }

        $update = Regsop::where('id', $id)->get()[0];
        $update->update([
            'no_sop' => $request->no_sop,
            'nama_sop' => $request->nama_sop,
            'desc_sop' => $request->desc_sop,
            'tgl_sop' => strtotime($request->tgl_sop),
            'bidang_sop' => $request->bidang_sop,
            'tahun' => date('Y')
        ]);


        if ($request->hasFile('word')) {
            $file     = $request->file('word');
            $ext      = $file->getClientOriginalExtension();
            $wordname = 'SOP_' . uniqid() . '.' . $ext;
            $file->storeAs('word', $wordname);

            Storage::delete('word/' . $update->word);
            $update->update(['word' => $wordname]);
        }

        if ($request->hasFile('pdf')) {
            $file     = $request->file('pdf');
            $ext      = $file->getClientOriginalExtension();
            $pdfname = 'SOP_' . uniqid() . '.' . $ext;
            $file->storeAs('pdf/', $pdfname);

            Storage::delete('pdf/' . $update->pdf);
            $update->update(['pdf' => $pdfname]);
        }

        Log::create([
            'user_id' => Auth::user()->id,
            'pesan_Log' => 'Mengedit SOP'
        ]);

        return redirect('/register/sop')->with('toast_success', 'Data berhasil di edit');
    }

    public function destroy(Regsop $regsop, $id)
    {
        Regsop::destroy($id);
        Log::create([
            'user_id' => Auth::user()->id,
            'pesan_Log' => 'Menghapus SOP'
        ]);
        return back()->with('toast_success', 'Data berhasil dihapus!');
    }
}
