<?php

namespace App\Http\Controllers\Admin;

use App\Pegawai;
use App\Jabatan;
use App\Pangkat;
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
        $data = Pegawai::where('status',1)->whereNull('deleted_at')->get();
        return view('settings/pegawai/index', ['data' => $data]);
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
            'pangkat' => 'required',
            'jabatan' => 'required'
        ]);
        
        Pegawai::create([
            'nama_pegawai' => $request->name,
            'nip' => $request->nip,
            'pangkat_id' => $request->pangkat,
            'jabatan' => $request->jabatan,
            'status' => 1
        ]);

        return redirect('/settings/pegawai')->with('message', 'Input Pegawai berhasil');
    }

    public function show(Pegawai $pegawai)
    {
        //
    }

    public function edit(Pegawai $pegawai)
    {
        $jabatan = Jabatan::all();
        $pangkat = Pangkat::all();
        return view('settings/pegawai/edit', compact('pegawai', 'jabatan', 'pangkat'));
    }

    public function update(Request $request, Pegawai $pegawai)
    {
        $validator = Validator::make($request->all(), [
            'nama_pegawai' => 'required',
            'tempat_lahir' => 'required',
            'nip' => 'required|integer',
            'pangkat_id' => 'required',
            'jabatan' => 'required',
            'alamat' => 'required',
            'foto'=>'file|nullable|max:1000|mimes:jpg,jpeg,png,bmp'
        ]);

        if ($validator->fails()) {
        return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }

        $update = Pegawai::where('id', $pegawai->id);

        $update->update([
            'nama_pegawai' => $request->nama_pegawai,
            'tempat_lahir' => $request->tempat_lahir,
            'nip' => $request->nip,
            'pangkat_id' => $request->pangkat_id,
            'jabatan' => $request->jabatan,
            'alamat' => $request->alamat
            ]);

        if($request->hasFile('foto')){
            $file     = $request->file('foto');
            $ext      = $file->getClientOriginalExtension();
            $picname  = 'Profil_'.uniqid().'.'.$ext;
            $file->storeAs('pic', $picname);
            
            Storage::delete('pic/'.$pegawai->foto);
            $update->update(['foto'=> $picname]);
        }
        
        return redirect('/settings/pegawai')->with('toast_success', 'Data berhasil di edit');
    }

    public function destroy(Pegawai $pegawai)
    {
        //
    }
}
