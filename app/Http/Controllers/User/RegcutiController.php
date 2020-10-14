<?php

namespace App\Http\Controllers\User;

use Auth;
use App\Regcuti;
use App\Pegawai;
use App\Jeniscuti;
use App\Log;
use Validator;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Response, Redirect;

class RegcutiController extends Controller
{
    public function index()
    {
        $data = Regcuti::all();
        return view('register/surat_cuti/index', ['data' => $data]);
    }

    public function create()
    {
        $jeniscuti = Jeniscuti::all();
        $pegawai = Pegawai::where('status', 1)->where('aktif', 1)->orderBy('jabatan_id')->get();
        return view('register/surat_cuti/create', compact('pegawai', 'jeniscuti'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pegawai_id' => 'required',
            'tgl_cuti' => 'required|date',
            'mulai' => 'required|date',
            'akhir' => 'required|date',
            'alamat' => 'required',
            'alasan' => 'required',
            'atasan_id' => 'required',
            'jenis_cuti' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }

        $jml_cuti = Helper::get_hari_kerja(strtotime($request->mulai), strtotime($request->akhir));

        Regcuti::create([
            'no_cuti' => 'W20-A17/     /KP.04.6/' . Helper::get_bulan_romawi(date('m')) . '/' . date('Y'),
            'pegawai_id' => $request->pegawai_id,
            'tgl_cuti' => strtotime($request->tgl_cuti),
            'mulai' => strtotime($request->mulai),
            'akhir' => strtotime($request->akhir),
            'alamat' => $request->alamat,
            'alasan' => $request->alasan,
            'atasan_id' => $request->atasan_id,
            'jenis_cuti' => $request->jenis_cuti,
            'jumlah_cuti' => $jml_cuti,
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
        $data = Regcuti::where('id', $id)->first();
        return view('register/surat_cuti/show', compact('data'));
    }

    public function edit($id)
    {
        $pegawai = Pegawai::where('status', 1)->where('aktif', 1)->orderBy('jabatan_id')->get();
        $jeniscuti = Jeniscuti::all();
        $data = Regcuti::where('id', $id)->get()[0];
        return view('/register/surat_cuti/edit', compact('pegawai', 'data', 'jeniscuti'));
    }

    public function update(Request $request, Regcuti $regcuti, $id)
    {
        $validator = Validator::make($request->all(), [
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
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }

        $jml_cuti = Helper::get_hari_kerja(strtotime($request->mulai), strtotime($request->akhir));

        $update = Regcuti::where('id', $id)->get()[0];

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
        Regcuti::destroy($id);
        Log::create([
            'user_id' => Auth::user()->id,
            'pesan_Log' => 'Menghapus Surat Cuti'
        ]);
        return back()->with('toast_success', 'Data berhasil dihapus!');
    }

    public function print($id)
    {
        $data = Regcuti::where('id', $id)->first();

        $ketua = Pegawai::where('jabatan_id',1)->where('aktif',1)->first();

        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(public_path('assets/template/surat_cuti.docx'));
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
            'alamat' => $data->alamat,
            'jc' => $data->jumlah_cuti,
            'masa_kerja' => Helper::masa_kerja($data->pegawai->nip),
            'atasan' => strtoupper($data->atasan->nama_pegawai),
            'nip_atasan' => $data->atasan->nip,
            'ketua'=>strtoupper($ketua->nama_pegawai),
            'nip_ketua'=>$ketua->nip
        ]);

        header("Content-Disposition: attachment; filename=surat_cuti.docx");

        $templateProcessor->saveAs('php://output');
    }
}
