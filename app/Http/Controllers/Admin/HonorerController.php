<?php

namespace App\Http\Controllers\Admin;
use App\Honorer;
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
        $data = Honorer::where('status',2)->whereNull('deleted_at')->get();
        return view('settings/pramubhakti/index', ['data' => $data]);
    }

    public function create()
    {
        return view('settings/pramubhakti/create');
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

        return redirect('/settings/pramubhakti')->with('success', 'Input Pramubhakti berhasil');
    }

    public function show($id)
    {
        return Honorer::where('id', $id)->get();
    }

    public function edit($id)
    {
        $data = Honorer::where('id', $id)->get()[0];
        return view('settings/pramubhakti/edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_pegawai' => 'required',
            'tempat_lahir' => 'required',
            'jabatan' => 'required',
            'alamat' => 'required',
            'foto'=>'file|nullable|max:1000|mimes:jpg,jpeg,png,bmp'
        ]);

        if ($validator->fails()) {
        return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }

        $update = Honorer::where('id', $id)->get()[0];
        $update->update([
            'nama_pegawai' => $request->nama_pegawai,
            'tempat_lahir' => $request->tempat_lahir,
            'jabatan' => $request->jabatan,
            'alamat' => $request->alamat
            ]);

        if($request->hasFile('foto')){
            $file     = $request->file('foto');
            $ext      = $file->getClientOriginalExtension();
            $picname  = 'Profil_'.uniqid().'.'.$ext;
            $file->storeAs('pic', $picname);
            
            Storage::delete('pic/'.$update->foto);
            $update->update(['foto'=> $picname]);
        }
        
        return redirect('/settings/pramubhakti')->with('toast_success', 'Data berhasil di edit');
    }

    public function destroy($id)
    {
        //
    }
}
