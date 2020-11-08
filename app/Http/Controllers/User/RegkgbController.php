<?php

namespace App\Http\Controllers\User;

use App\Regkgb;
use App\Pegawai;
use App\Log;
use Auth;
use Validator;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Response, Redirect;

class RegkgbController extends Controller
{
	public function index()
	{
		$data = Regkgb::all();
		return view('register/kgb/index', compact('data'));
	}

	public function create()
	{
		$pegawai = Pegawai::whereStatus(1)->orderBy('jabatan_id')->get();
		return view('register/kgb/create', compact('pegawai'));
	}

	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'pegawai_id' => 'required',
			'tgl_kgb' => 'required|date',
			'gapok_baru' => 'required|numeric|integer',
			'masa_kerja' => 'required',
			'tmt_kgb' => 'required|date',
			'kgb_lama' => 'required',
			'tgl_kgb_lama' => 'required|date',
			'gapok_lama' => 'required|numeric|integer',
			'masa_kerja_lama' => 'required',
			'tmt_kgb_lama' => 'required|date',
			'pejabat_kgb_lama' => 'required',
		]);

		if ($validator->fails()) {
			return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
		}

		$bulan = Helper::get_bulan_romawi(date('m'));

		Regkgb::create([
			'pegawai_id' => $request->pegawai_id,
			'no_kgb' => 'W20-A7/     /KP.04.2/' . $bulan . '/' . date('Y'),
			'tgl_kgb' => strtotime($request->tgl_kgb),
			'gapok_baru' => $request->gapok_baru,
			'masa_kerja' => $request->masa_kerja,
			'tmt_kgb' => strtotime($request->tmt_kgb),
			'kgb_lama' => $request->kgb_lama,
			'tgl_kgb_lama' => strtotime($request->tgl_kgb_lama),
			'gapok_lama' => $request->gapok_lama,
			'masa_kerja_lama' => $request->masa_kerja_lama,
			'tmt_kgb_lama' => strtotime($request->tmt_kgb_lama),
			'pejabat_kgb_lama' => $request->pejabat_kgb_lama,
			'tmt_yad' => strtotime($request->tmt_kgb) + 63080000,
			'tahun' => date('Y')
		]);

		Pegawai::findOrFail($request->pegawai_id)->update([
			'kgb_yad' => strtotime($request->tmt_kgb) + 63080000
		]);

		Log::create([
			'user_id' => Auth::user()->id,
			'pesan_Log' => 'Membuat Surat KGB'
		]);

		return redirect('/register/kgb')->withToastSuccess('Input data berhasil');
	}

	public function show($id)
	{
		$data = Regkgb::findOrFail($id);
		return view('register/kgb/show', compact('data'));
	}

	public function edit($id)
	{
		$data = Regkgb::findOrFail($id);
		return view('register/kgb/edit', compact('data'));
	}

	public function update(Request $request, $id)
	{
		$validator = Validator::make($request->all(), [
			'tgl_kgb' => 'required|date',
			'gapok_baru' => 'required|numeric|integer',
			'masa_kerja' => 'required',
			'tmt_kgb' => 'required|date',
			'kgb_lama' => 'required',
			'tgl_kgb_lama' => 'required|date',
			'gapok_lama' => 'required|numeric|integer',
			'masa_kerja_lama' => 'required',
			'tmt_kgb_lama' => 'required|date',
			'pejabat_kgb_lama' => 'required'
		]);

		if ($validator->fails()) {
			return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
		}

		$update = Regkgb::findOrFail($id);
		$update->update([
			'no_kgb' => $request->no_kgb,
			'tgl_kgb' => strtotime($request->tgl_kgb),
			'gapok_baru' => $request->gapok_baru,
			'masa_kerja' => $request->masa_kerja,
			'tmt_kgb' => strtotime($request->tmt_kgb),
			'kgb_lama' => $request->kgb_lama,
			'tgl_kgb_lama' => strtotime($request->tgl_kgb_lama),
			'gapok_lama' => $request->gapok_lama,
			'masa_kerja_lama' => $request->masa_kerja_lama,
			'tmt_kgb_lama' => strtotime($request->tmt_kgb_lama),
			'pejabat_kgb_lama' => $request->pejabat_kgb_lama,
			'tmt_yad' => strtotime($request->tmt_kgb) + 63080000,
			'tahun' => date('Y')
		]);

		Pegawai::findOrFail($request->pegawai_id)->update([
			'kgb_yad' => strtotime($request->tmt_kgb) + 63080000
		]);


		if ($request->hasFile('word')) {
			$file     = $request->file('word');
			$ext      = $file->getClientOriginalExtension();
			$wordname = 'KGB_' . uniqid() . '.' . $ext;
			$file->storeAs('word', $wordname);

			Storage::delete('word/' . $update->word);
			$update->update(['word' => $wordname]);
		}

		if ($request->hasFile('pdf')) {
			$file     = $request->file('pdf');
			$ext      = $file->getClientOriginalExtension();
			$pdfname = 'KGB_' . uniqid() . '.' . $ext;
			$file->storeAs('pdf/', $pdfname);

			Storage::delete('pdf/' . $update->pdf);
			$update->update(['pdf' => $pdfname]);
		}

		Log::create([
			'user_id' => Auth::user()->id,
			'pesan_Log' => 'Mengedit Surat KGB'
		]);

		return redirect('/register/kgb')->withToastSuccess('Data berhasil dirubah');
	}

	public function destroy($id)
	{
		Regkgb::destroy($id);
		Log::create([
			'user_id' => Auth::user()->id,
			'pesan_Log' => 'Menghapus Surat KGB'
		]);
		return back()->with('toast_success', 'Data berhasil dihapus!');
	}

	public function get_data($id)
	{
		$d = Pegawai::findOrFail($id);
		$mk = Helper::masa_kerja($d->nip);
		return [$d, $mk];
	}

	public function print($id)
	{
		$data = Regkgb::findOrFail($id);

		\PhpOffice\PhpWord\Settings::setOutputEscapingEnabled(true);

		$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(public_path('assets/template/kgb.docx'));

		$templateProcessor->setValues([
			'no_kgb' => $data->no_kgb,
			'pegawai' => $data->pegawai->nama_pegawai,
			'ttl' => $data->pegawai->tempat_lahir,
			'nip' => $data->pegawai->nip,
			'pangkat' => $data->pegawai->pangkat->nama_pangkat . ' (' . $data->pegawai->pangkat->golongan . ')',
			'satker' => 'Pengadilan Agama Selayar',
			'gapok_lama' => 'Rp. ' . number_format($data->gapok_lama, 0, ',', '.'),
			'gapok_baru' => 'Rp. ' . number_format($data->gapok_baru, 0, ',', '.'),
			'masker_gol' => $data->masa_kerja,
			'tmt_baru' => Helper::tanggal_id($data->tmt_kgb),
			'pejabat' => $data->pejabat_kgb_lama,
			'no_sk_lama' => $data->kgb_lama,
			'tgl_sk_lama' => Helper::tanggal_id($data->tgl_kgb_lama),
			'tmt_lama' => Helper::tanggal_id($data->tmt_kgb_lama),
			'masker_lama' => $data->masa_kerja_lama,
			'kgb_yad' => Helper::tanggal_id($data->tmt_yad),
			'tgl_surat' => Helper::tanggal_id($data->tgl_kgb)
		]);

		header("Content-Disposition: attachment; filename=kgb.docx");

		$templateProcessor->saveAs('php://output');
	}
}
