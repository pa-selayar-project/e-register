<?php

namespace App\Http\Controllers\User;

use App\Regsop;
use App\Log;
use Auth;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Response, Redirect;

class RegsopController extends Controller
{
    public function index()
    {
        $data = Regsop::whereTahun(date('Y'))->get();
        $back = Helper::back_button();
        $tombol = Helper::rekam('Tambah SOP');
        return view('register/sop/index', compact('data','back','tombol'));
    }

    public function store(Request $request)
    {
        $this->validasiRequest();
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

        return redirect('/register/sop')->withSuccess('Input data berhasil');
    }

    public function show($id)
    {
        $data = Regsop::findOrFail($id);
        $back = Helper::back_button();
        return view('register/sop/show', compact('data','back'));
    }

    public function edit(Regsop $regsop, $id)
    { 
        $data = Regsop::findOrFail($id);
        $back = Helper::back_button();
        return view('register/sop/edit', compact('data','back'));
    }

    public function update(Request $request, Regsop $regsop, $id)
    {
        $this->validasiRequest();
        $update = Regsop::findOrFail($id);
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

        return redirect('/register/sop')->withSuccess('Data berhasil di edit');
    }

    public function destroy($id)
    {
        Regsop::destroy($id);
        Log::create([
            'user_id' => Auth::user()->id,
            'pesan_Log' => 'Menghapus SOP'
        ]);
        return Redirect::back()->withSuccess('Data berhasil dihapus!');
    }

    private function validasiRequest()
	{
		$messages= [
			'required'=>'Wajib diisi !',
			'date'=>'Harus Format Tanggal !',
			'pdf.mimes'=>'Format harus Pdf',
			'pdf.max'=>'Ukuran File Max 2MB',
			'word.mimes'=>'Format harus Doc, Docx',
			'word.max'=>'Ukuran File Max 1MB',
		];

		return request()->validate([
			'no_sop' => 'required',
            'nama_sop' => 'required',
            'tgl_sop' => 'required',
            'bidang_sop' => 'required',
            'word' => 'file|nullable|max:1000|mimes:doc,docx',
            'pdf' => 'file|nullable|max:3000|mimes:pdf'
		], $messages);
	}
}
