<?php

namespace App\Http\Controllers\Admin;

use App\Pegawai;
use App\Jabatan;
use App\Pangkat;
use App\Log;
use App\Helpers\Helper;
use Auth;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Response, Redirect;

class PegawaiController extends Controller
{
  public function index()
  {
    $data = Pegawai::whereStatus(1)->orderBy('jabatan_id')->get();
    $back = Helper::back_button();
    $tombol = Helper::rekam('Tambah Pegawai');
    return view('settings/pegawai/index', compact('data','back','tombol'));
  }

  public function create()
  {
    $jabatan = Jabatan::all();
    $pangkat = Pangkat::all();
    return view('settings/pegawai/create', ['jabatan' => $jabatan, 'pangkat' => $pangkat]);
  }

  public function store(Request $request)
  {
    $request->validate([
    	'name' => 'required',
      'nip' => 'required|integer|unique:tb_pegawai',
      'pangkat_id' => 'required',
      'jabatan_id' => 'required'
    ]);

    Pegawai::create([
    	'nama_pegawai' => $request->name,
      'nip' => $request->nip,
      'pangkat_id' => $request->pangkat_id,
      'jabatan_id' => $request->jabatan_id,
      'status' => 1,
      'aktif' => 1,
      'foto' => 'user.png'
    ]);

    Log::create([
			'user_id' => Auth::user()->id,
			'pesan_Log' => 'Menambahkan Pegawai Baru'
		]);

    return redirect('/settings/pegawai')->with('message', 'Input Pegawai berhasil');
  }

  public function edit(Pegawai $pegawai)
  {
    $jabatan = Jabatan::all();
    $pangkat = Pangkat::all();
    return view('settings/pegawai/edit', compact('pegawai', 'jabatan', 'pangkat'));
  }

	public function show(Pegawai $pegawai)
	{
		//
	}

  public function update(Request $request, Pegawai $pegawai)
  {
    $validator = Validator::make($request->all(), [
      'nama_pegawai' => 'required',
      'tempat_lahir' => 'required',
      'nip' => 'required|integer',
      'pangkat_id' => 'required',
      'jabatan_id' => 'required',
      'alamat' => 'required',
      'kgb_yad' => 'required',
      'kp_yad' => 'required',
      'sisa_cuti' => 'required',
      'foto' => 'file|nullable|max:1000|mimes:jpg,jpeg,png,bmp'
    ]);

    if ($validator->fails()) {
      return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
    }

    $update = Pegawai::findOrFail($pegawai->id);

    $update->update([
      'nama_pegawai' => $request->nama_pegawai,
      'tempat_lahir' => $request->tempat_lahir,
      'nip' => $request->nip,
      'pangkat_id' => $request->pangkat_id,
      'jabatan_id' => $request->jabatan_id,
      'alamat' => $request->alamat,
      'kgb_yad' => strtotime($request->kgb_yad),
      'kp_yad' => strtotime($request->kp_yad),
      'sisa_cuti' => $request->sisa_cuti,
      'aktif' => $request->aktif
    ]);

    if ($request->aktif == null) {
      $update->update(['aktif' => 2]);
    }

    if ($request->hasFile('foto')) {
      $file     = $request->file('foto');
      $ext      = $file->getClientOriginalExtension();
      $picname  = 'Profil_' . uniqid() . '.' . $ext;
      $file->storeAs('pic', $picname);

      Storage::delete('pic/' . $pegawai->foto);
      $update->update(['foto' => $picname]);
    }

    return redirect('/settings/pegawai')->with('toast_success', 'Data berhasil di edit');
  }

  public function destroy(Pegawai $pegawai)
  {
		$hapus = Pegawai::destroy($pegawai->id);
		Response::Json($hapus);
		return redirect('/settings/pegawai')->with('toast_success', 'Data berhasil di hapus');
	}
	
	public function trash()
	{
		$data = Pegawai::onlyTrashed()->orderBy('jabatan_id')->get();
    $back = Helper::back_button();
		return view('settings/pegawai/trash', compact('data','back'));
	}
}
