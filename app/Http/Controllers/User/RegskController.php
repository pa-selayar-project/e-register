<?php

namespace App\Http\Controllers\User;

use App\Regsk;
use App\Pegawai;
use App\Log;
use Auth;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Response, Redirect;

class RegskController extends Controller
{
	public function index()
	{
		$user = Auth::user();
		$pegawai = Pegawai::findOrFail($user->id_pegawai);
		if($user->id_level == 3){
			$data = Regsk::where('obyek', 'LIKE', '%'.$pegawai->nip.'%')->whereTahun(date('Y'))->get();
		}else{
			$data = Regsk::whereTahun(date('Y'))->get();
		}	
				
		return view('register/regsk/index', compact('data'));
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
			'created_at' => date_format(date_create(), 'Y-m-d H:i:s'),
		]);

		Log::create([
			'user_id' => Auth::user()->id,
			'pesan_Log' => 'Mengiput SK'
		]);

		return redirect('/register/regsk')->withToastSuccess('Input data berhasil');
	}

	public function show(Regsk $regsk)
	{
		$obyek = Pegawai::whereIn('nip', explode(',',$regsk->obyek))->orderBy('jabatan_id','ASC')->get();
		return view('register/regsk/show', compact('regsk', 'obyek'));;
	}

	public function edit(Regsk $regsk)
	{
		$pegawai = Pegawai::orderBy('jabatan_id','ASC')->get();
		return view('register/regsk/edit', compact('regsk', 'pegawai'));
	}

	public function update(Request $request, Regsk $regsk)
	{
		$this->validasiRequest();
		$update = Regsk::findOrFail($regsk->id);
		if ($request->obyek != "") {
			$obyek = implode(',', $request->obyek);
		} else {
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

		if ($request->hasFile('word')) {
			$file     = $request->file('word');
			$ext      = $file->getClientOriginalExtension();
			$wordname = 'SK_' . uniqid() . '.' . $ext;
			$file->storeAs('word', $wordname);

			Storage::delete('word/' . $regsk->word);
			$update->update(['word' => $wordname]);
		}

		if ($request->hasFile('pdf')) {
			$file     = $request->file('pdf');
			$ext      = $file->getClientOriginalExtension();
			$pdfname = 'SK_' . uniqid() . '.' . $ext;
			$file->storeAs('pdf/', $pdfname);

			Storage::delete('pdf/' . $regsk->pdf);
			$update->update(['pdf' => $pdfname]);
		}

		Log::create([
			'user_id' => Auth::user()->id,
			'pesan_Log' => 'Mengedit SK'
		]);

		return redirect('/register/regsk')->with('toast_success', 'Data berhasil di edit');
	}

	public function destroy(Regsk $regsk)
	{
		Regsk::destroy($regsk->id);
		Log::create([
			'user_id' => Auth::user()->id,
			'pesan_Log' => 'Menghapus SK'
		]);
		return back()->with('toast_success', 'Data berhasil dihapus!');
	}
	
	public function import(Request $request)
	{
		$request->validate(
			['xls' => 'required|mimes:xls,xlsx'],
			['required' => ':attribute wajib diisi',
				'mimes' => 'File harus format Excel'
			]
		);
		Excel::import(new \App\Imports\RegskImport, $request->file('xls'));
		return back()->with('toast_success', 'Data berhasil diinput ke database!');
	}

	private function validasiRequest()
	{
		$messages = [
			'required'=>'Wajib diisi !',
			'date'=>'Harus Format Tanggal !',
			'pdf.mimes'=>'Format harus Pdf',
			'pdf.max'=>'Ukuran File Max 10MB',
			'word.mimes'=>'Format harus Doc, Docx',
			'word.max'=>'Ukuran File Max 1MB'
		];

		return request()->validate([
			'no_sk' => 'required',
			'nama_sk' => 'required',
			'desc_sk' => 'required',
			'tgl_sk' => 'required',
			'bidang_sk' => 'required',
			'ttd_sk' => 'required',
			'obyek' => 'nullable',
			'word' => 'file|nullable|max:1000|mimes:docx,doc',
			'pdf' => 'file|nullable|max:10000|mimes:pdf',
		], $messages);
	}
}
