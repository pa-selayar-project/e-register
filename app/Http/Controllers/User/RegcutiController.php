<?php

namespace App\Http\Controllers\User;

use Auth;
use App\Regcuti;
use App\Pegawai;
use App\Jeniscuti;
use App\Log;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Response, Redirect;

class RegcutiController extends Controller
{
	public function index()
	{
		if(Auth::user()->id_level == 3){
			$data = Regcuti::wherePegawaiId(Auth::user()->id_pegawai)->whereTahun(date('Y'))->get();
		}else{
			$data = Regcuti::whereTahun(date('Y'))->get();
		}
		return view('register/surat_cuti/index', ['data' => $data]);
	}

	public function create()
	{
		$jeniscuti = Jeniscuti::all();
		if(Auth::user()->level == 3){
			$pegawai = Pegawai::whereId(Auth::user()->id_pegawai)->get();
		}else{
			$pegawai = Pegawai::whereStatus(1)->orderBy('jabatan_id')->get();
		}
		return view('register/surat_cuti/create', compact('pegawai', 'jeniscuti'));
	}

	public function store(Request $request)
	{
		$this->validasiRequest();
		$jml_cuti = Helper::get_hari_kerja(strtotime($request->mulai), strtotime($request->akhir));	

		$pegawai = Pegawai::find($request->pegawai_id);
		$sisa_cuti = $pegawai->sisa_cuti;
		$update_cuti = $sisa_cuti - $jml_cuti;
		if($update_cuti<0){
			$update_cuti = 0;
		}
		$pegawai->update(['sisa_cuti'=> $update_cuti]);

		Regcuti::create([
			'no_cuti' => 'W20-A17/     /KP.05.2/' . Helper::get_bulan_romawi(date('m')) . '/' . date('Y'),
			'pegawai_id' => $request->pegawai_id,
			'tgl_cuti' => strtotime($request->tgl_cuti),
			'mulai' => strtotime($request->mulai),
			'akhir' => strtotime($request->akhir),
			'alamat' => $request->alamat,
			'alasan' => $request->alasan,
			'atasan_id' => $request->atasan_id,
			'jenis_cuti' => $request->jenis_cuti,
			'jumlah_cuti' => $jml_cuti,
			'sisa_cuti' => $update_cuti,
			'tahun' => date('Y')
		]);
		
		Log::create([
			'user_id' => Auth::user()->id,
			'pesan_Log' => 'Membuat Surat Cuti'
		]);

		return redirect('/register/surat_cuti')->withToastSuccess('Input data berhasil');
	}

	public function show($id)
	{
		$data = Regcuti::findOrFail($id);
		return view('register/surat_cuti/show', compact('data'));
	}

	public function edit($id)
	{
		$pegawai = Pegawai::whereStatus(1)->orderBy('jabatan_id')->get();
		$jeniscuti = Jeniscuti::all();
		$data = Regcuti::findOrFail($id);
		return view('/register/surat_cuti/edit', compact('pegawai', 'data', 'jeniscuti'));
	}

	public function update(Request $request, Regcuti $regcuti, $id)
	{
		$this->validasiRequest();
		$jml_cuti = Helper::get_hari_kerja(strtotime($request->mulai), strtotime($request->akhir));

		$update = Regcuti::find($id);

		$update->update([
			'no_cuti' => $request->no_cuti,
			'pegawai_id' => $request->pegawai_id,
			'tgl_cuti' => strtotime($request->tgl_cuti),
			'mulai' => strtotime($request->mulai),
			'akhir' => strtotime($request->akhir),
			'alamat' => $request->alamat,
			'alasan' => $request->alasan,
			'atasan_id' => $request->atasan_id,
			'jenis_cuti' => $request->jenis_cuti,
			'jumlah_cuti' => $jml_cuti
		]);

		Log::create([
			'user_id' => Auth::user()->id,
			'pesan_Log' => 'Mengedit Surat Cuti'
		]);

		if ($request->hasFile('word')) {
			$file     = $request->file('word');
			$ext      = $file->getClientOriginalExtension();
			$wordname = 'SC_' . uniqid() . '.' . $ext;
			$file->storeAs('word', $wordname);

			Storage::delete('word/' . $update->word);
			$update->update(['word' => $wordname]);
		}

		if ($request->hasFile('pdf')) {
			$file     = $request->file('pdf');
			$ext      = $file->getClientOriginalExtension();
			$pdfname = 'SC_' . uniqid() . '.' . $ext;
			$file->storeAs('pdf/', $pdfname);

			Storage::delete('pdf/' . $update->pdf);
			$update->update(['pdf' => $pdfname]);
		}

		return redirect('/register/surat_cuti')->withToastSuccess('Data berhasil diubah');
	}

	public function destroy($id)
	{
		$cuti = Regcuti::find($id);
		$pegawai = Pegawai::withTrashed()->find($cuti->pegawai_id);
		
		$restore_cuti = $cuti->jumlah_cuti + $pegawai->sisa_cuti;
		if($restore_cuti > 12){
			$restore_cuti = 12;
		}
		$pegawai->update(["sisa_cuti" => $restore_cuti]);

		Regcuti::destroy($id);
		Log::create([
			'user_id' => Auth::user()->id,
			'pesan_Log' => 'Menghapus Surat Cuti'
		]);
		return back()->with('toast_success', 'Data berhasil dihapus!');
  }

	public function get_data($id)
	{
		$data = Pegawai::find($id);
		return $data;
	}

	public function print($id)
	{
		$data = Regcuti::findOrFail($id);

		$ketua = Pegawai::whereJabatanId(1)->first();

		$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(public_path('assets/template/surat_cuti_'.$data->jenis_cuti.'.docx'));
		
		$templateProcessor->setValues([
			'no_cuti' => $data->no_cuti,
			'tgl_cuti' => Helper::tanggal_id($data->tgl_cuti),
			'pegawai' => strtoupper($data->pegawai->nama_pegawai),
			'nip' => $data->pegawai->nip,
			'jabatan' => strtoupper($data->pegawai->jabatan->nama_jabatan),
			'pangkat' => strtoupper($data->pegawai->pangkat->nama_pangkat),
			'golongan' => $data->pegawai->pangkat->golongan,
			'hp' => $data->pegawai->hp,
			'mulai' => Helper::tanggal_id($data->mulai),
			'akhir' => Helper::tanggal_id($data->akhir),
			'alasan' => $data->alasan,
			'alamat' => $data->alamat,
			'jc' => $data->jumlah_cuti,
			'masa_kerja' => Helper::masa_kerja($data->pegawai->nip),
			'atasan' => strtoupper($data->atasan->nama_pegawai),
			'nip_atasan' => $data->atasan->nip,
			'ketua'=>strtoupper($ketua->nama_pegawai),
			'nip_ketua'=>$ketua->nip,
			'n' => date('Y'),
			'n1' => date('Y')-1,
			'n2' => date('Y')-2,
			'sc' => $data->pegawai->sisa_cuti,
			'sc_1' => $data->pegawai->sisa_cuti_1,
			'sc_2' => $data->pegawai->sisa_cuti_2,
		]);

		header("Content-Disposition: attachment; filename=surat_cuti.docx");

		$templateProcessor->saveAs('php://output');
	}

	private function validasiRequest()
	{
		$messages = [
			'required'=>'Wajib diisi !',
			'date'=>'Harus Format Tanggal !',
			'pdf.mimes'=>'Format harus Pdf',
			'pdf.max'=>'Ukuran File Max 2MB',
			'word.mimes'=>'Format harus Doc, Docx',
			'word.max'=>'Ukuran File Max 1MB'
		];

		return request()->validate([
					'pegawai_id' => 'required',
					'tgl_cuti' => 'required|date',
					'mulai' => 'required|date',
					'akhir' => 'required|date',
					'alamat' => 'required',
					'alasan' => 'required',
					'atasan_id' => 'required',
					'jenis_cuti' => 'required',
					'word' => 'file|nullable|max:1000|mimes:doc,docx',
					'pdf' => 'file|nullable|max:3000|mimes:pdf'
					], $messages);
	}
}
