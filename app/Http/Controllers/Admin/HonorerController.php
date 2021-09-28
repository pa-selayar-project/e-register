<?php

namespace App\Http\Controllers\Admin;

use App\Honorer;
use App\Jabatan;
use App\Log;
use App\Helpers\Helper;
use Auth;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Response, Redirect;

class HonorerController extends Controller
{
    public function index()
    {
        $data = Honorer::whereStatus(2)->get();
        $back = Helper::back_button();
        return view('settings/pramubhakti/index', compact('data','back'));
    }

    public function create()
    {
        $jabatan = Jabatan::whereIn('id',[19,20,21])->get();
        return view('settings/pramubhakti/create', compact('jabatan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'jabatan' => 'required'
        ]);

        Honorer::create([
            'nama_pegawai' => $request->name,
            'nip' => 111111111111111111,
            'pangkat_id' => 0,
            'jabatan' => $request->jabatan,
            'status' => 2
        ]);

        Log::create([
            'user_id' => Auth::user()->id,
            'pesan_Log' => 'Menambahkan Tenaga Honorer Baru'
        ]);

        return redirect('/settings/pramubhakti')->with('success', 'Input Pramubhakti berhasil');
    }

    public function show($id)
    {
        return Honorer::where('id', $id)->get();
    }

    public function edit($id)
    {
        $data = Honorer::where('id', $id)->get()[0];
        $jabatan = Jabatan::where('id', '>', 18)->get();
        return view('settings/pramubhakti/edit', compact('data', 'jabatan'));
    }

  public function update(Request $request, $id)
  {
    $validator = Validator::make($request->all(), [
      'nama_pegawai' => 'required',
      'tempat_lahir' => 'required',
      'jabatan_id' => 'required',
      'alamat' => 'required',
      'foto' => 'file|nullable|max:1000|mimes:jpg,jpeg,png,bmp'
    ]);

    if ($validator->fails()) {
      return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
      }

      $update = Honorer::where('id', $id)->get()[0];
      $update->update([
        'nama_pegawai' => $request->nama_pegawai,
        'tempat_lahir' => $request->tempat_lahir,
        'jabatan_id' => $request->jabatan_id,
        'alamat' => $request->alamat
      ]);

      if ($request->hasFile('foto')) {
        $file     = $request->file('foto');
        $ext      = $file->getClientOriginalExtension();
        $picname  = 'Profil_' . uniqid() . '.' . $ext;
        $file->storeAs('pic', $picname);

        Storage::delete('pic/' . $update->foto);
        $update->update(['foto' => $picname]);
      }

      Log::create([
        'user_id' => Auth::user()->id,
        'pesan_Log' => 'Mengedit Profil Honorer'
      ]);

      return redirect('/settings/pramubhakti')->with('toast_success', 'Data berhasil di edit');
    }

	public function destroy($id)
  {
    Honorer::destroy($id);
		Log::create([
			'user_id' => Auth::user()->id,
			'pesan_Log' => 'Menghapus Data Honorer'
		]);
		return back()->with('toast_success', 'Data berhasil dihapus!');
  }
}
