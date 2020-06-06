<?php

namespace App\Http\Controllers\User;

use App\Regstugas;
use App\Pegawai;
use App\Log;
use Auth;
use Validator;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Response, Redirect;

class RegstugasController extends Controller
{
	public function index()
	{
		$data = Regstugas::all();
		$pgw = Pegawai::where('aktif', 1)->orderBy('jabatan_id')->get();
		return view('register/surat_tugas/index', ['data' => $data, 'pgw' => $pgw]);
	}

	public function create()
	{
		$pelaksana = Pegawai::where('aktif', 1)->orderBy('jabatan_id')->get();
		$penandatangan = Pegawai::where('jabatan_id', '<=', 2)->where('aktif', 1)->orderBy('jabatan_id')->get();
		return view('register/surat_tugas/create', compact('pelaksana', 'penandatangan'));
	}

	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'no_stugas' => 'required',
			'tgl_stugas' => 'required|date',
			'ttd_stugas' => 'required',
			'pegawai' => 'required',
			'menimbang' => 'required',
			'dasar' => 'required',
			'maksud' => 'required',
			'dipa' => 'required'
		]);

		if ($validator->fails()) {
			return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
		}

		Regstugas::create([
			'no_stugas' => $request->no_stugas,
			'pegawai' => implode(',', $request->pegawai),
			'tgl_stugas' => strtotime($request->tgl_stugas),
			'ttd_stugas' => $request->ttd_stugas,
			'menimbang' => $request->menimbang,
			'dasar' => $request->dasar,
			'maksud' => $request->maksud,
			'dipa' => $request->dipa,
			'tahun' => date('Y')
		]);

		Log::create([
			'user_id' => Auth::user()->id,
			'pesan_Log' => 'Membuat Surat Tugas'
		]);

		return redirect('/register/surat_tugas')->withToastSuccess('Input data berhasil');
	}

	public function show($id)
	{
		$data = Regstugas::where('id', $id)->get()[0];
		$tgl = Helper::tanggal_id($data->tgl_stugas);
		$pelaksana = explode(',', $data->pegawai);
		$pelaksana = Pegawai::whereIn('id', $pelaksana)->orderBy('jabatan_id')->get();
		return view('register/surat_tugas/show', compact('data', 'pelaksana', 'tgl'));
	}

	public function edit($id)
	{
		$data = Regstugas::where('id', $id)->get()[0];
		$pelaksana = Pegawai::where('aktif', 1)->orderBy('jabatan_id')->get();
		$penandatangan = Pegawai::where('jabatan_id', '<=', 2)->where('aktif', 1)->orderBy('jabatan_id')->get();
		return view('register/surat_tugas/edit', compact('data', 'penandatangan', 'pelaksana'));
	}

	public function update(Request $request, Regstugas $regstugas, $id)
	{
		$validator = Validator::make($request->all(), [
			'no_stugas' => 'required',
			'tgl_stugas' => 'required|date',
			'ttd_stugas' => 'required',
			'pegawai' => 'required',
			'menimbang' => 'required',
			'dasar' => 'required',
			'maksud' => 'required',
			'dipa' => 'required',
			'word' => 'file|nullable|max:1000|mimes:doc,docx',
			'pdf' => 'file|nullable|max:3000|mimes:pdf'
		]);

		if ($validator->fails()) {
			return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
		}

		$update = Regstugas::where('id', $id)->get()[0];

		$update->update([
			'no_stugas' => $request->no_stugas,
			'pegawai' => implode(',', $request->pegawai),
			'tgl_stugas' => strtotime($request->tgl_stugas),
			'ttd_stugas' => $request->ttd_stugas,
			'menimbang' => $request->menimbang,
			'dasar' => $request->dasar,
			'maksud' => $request->maksud,
			'dipa' => $request->dipa,
		]);

		Log::create([
			'user_id' => Auth::user()->id,
			'pesan_Log' => 'Mengedit Surat Tugas'
		]);

		if ($request->hasFile('word')) {
			$file     = $request->file('word');
			$ext      = $file->getClientOriginalExtension();
			$wordname = 'Surat_Tugas_' . uniqid() . '.' . $ext;
			$file->storeAs('word', $wordname);

			Storage::delete('word/' . $update->word);
			$update->update(['word' => $wordname]);
		}

		if ($request->hasFile('pdf')) {
			$file     = $request->file('pdf');
			$ext      = $file->getClientOriginalExtension();
			$pdfname = 'Surat_Tugas_' . uniqid() . '.' . $ext;
			$file->storeAs('pdf/', $pdfname);

			Storage::delete('pdf/' . $update->pdf);
			$update->update(['pdf' => $pdfname]);
		}

		return redirect('/register/surat_tugas')->withToastSuccess('Data berhasil diubah');
	}

	public function destroy($id)
	{
		Regstugas::destroy($id);
		Log::create([
			'user_id' => Auth::user()->id,
			'pesan_Log' => 'Menghapus Surrat Tugas'
		]);
		return back()->with('toast_success', 'Data berhasil dihapus!');
	}

	public function print($id)
	{
		$data = Regstugas::where('id', $id)->first();
		$arr_pelaksana = explode(',', $data->pegawai);

		$hitung = count($arr_pelaksana);

		$pegawai = Pegawai::where('aktif', 1)->whereIn('id', $arr_pelaksana)->orderBy('jabatan_id')->get();

		\PhpOffice\PhpWord\Settings::setOutputEscapingEnabled(true);
		$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(public_path('assets/template/surat_tugas_' . $hitung . '.docx'));

		if ($data->dipa == 1) {
			$dipa = 'Biaya kegiatan ini dibebankan kepada DIPA Pengadilan Agama Selayar Tahun Anggaran ' . date('Y');
		} else {
			$dipa = '-';
		}

		$templateProcessor->setValues([
			'nomor' => $data->no_stugas,
			'tgl' => Helper::tanggal_id($data->tgl_stugas),
			'menimbang' => $data->menimbang,
			'dasar' => $data->dasar,
			'maksud' => $data->maksud,
			'ket' => $dipa
		]);

		for ($i = 0; $i < $hitung; $i++) {
			$templateProcessor->setValues([
				'pegawai' . $i => $pegawai[$i]->nama_pegawai,
				'nip' . $i => $pegawai[$i]->nip,
				'pangkat' . $i => $pegawai[$i]->pangkat->nama_pangkat,
				'gol' . $i => $pegawai[$i]->pangkat->golongan,
				'jabatan' . $i => $pegawai[$i]->jabatan->nama_jabatan
			]);
		}


		header("Content-Disposition: attachment; filename=surat_tugas.docx");

		$templateProcessor->saveAs('php://output');
	}
}
