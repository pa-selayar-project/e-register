<?php

namespace App\Http\Controllers\Admin;

use App\Setting;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Response, Redirect;

class SettingController extends Controller
{
    public function index()
    {
        $data = Setting::where('id',1)->first();
        return view('settings/setting/index', compact('data'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Setting $setting)
    {
        //
    }

    public function edit($id)
    {
        $data = Setting::where('id', $id)->first();
        return view('settings/setting/edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_aplikasi' => 'required',
            'versi' => 'required',
            'author'=> 'required',
            'logo_besar' => 'file|max:1000|mimes:jpg,jpeg,png',
            'logo_kecil' => 'file|max:1000|mimes:jpg,jpeg,png'
        ]);

        if ($validator->fails()) {
        return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }

        $update = Setting::where('id', $id)->first();

        $update->update([
            'nama_aplikasi' => $request->nama_aplikasi,
            'versi' => $request->versi,
            'author' => $request->author
        ]);

        if($request->hasFile('logo_besar')){
            $file     = $request->file('logo_besar');
            $ext      = $file->getClientOriginalExtension();
            $image    = 'logo_'.uniqid().'.'.$ext;
            $file->storeAs('images/logo', $image);
            Storage::delete('images/logo'.$update->logo_besar);
            
            $update->update(['logo_besar'=> $image]);
        }

        if($request->hasFile('logo_kecil')){
            $file     = $request->file('logo_kecil');
            $ext      = $file->getClientOriginalExtension();
            $image    = 'logo_'.uniqid().'.'.$ext;
            $file->storeAs('images/logo', $image);
            Storage::delete('images/logo'.$update->logo_kecil);
            
            $update->update(['logo_kecil'=> $image]);
        }

        return redirect('settings/setting')->withToastSuccess('Data berhasil diubah');
    }
}
