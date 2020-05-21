<?php

namespace App\Http\Controllers\User;

use App\Profil;
use Auth;
use Hash;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Response, Redirect;

class ProfilController extends Controller
{
    public function index()
    {
        $data = Profil::where('id', Auth::user()->id)->first();
        return view('profil/index', compact('data'));
    }

    public function edit($id)
    {
        $data = Profil::where('id', Auth::user()->id)->first();
        return view('profil/edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'image' => 'file|nullable|max:1000|mimes:jpg,jpeg,png'
        ]);

        if ($validator->fails()) {
        return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }

        $update = Profil::where('id', $id)->first();

        $update->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        if($request->hasFile('image')){
            $file     = $request->file('image');
            $ext      = $file->getClientOriginalExtension();
            $image    = 'user_'.uniqid().'.'.$ext;
            $file->storeAs('pic', $image);
            if($update->image!== 'user.png'){
                Storage::delete('pic/'.$update->image);
            }
            $update->update(['image'=> $image]);
        }

        return redirect('/profil')->withToastSuccess('Data berhasil diubah');
    }

    // public function destroy(Profil $profil)
    // {
    //     //
    // }

    public function ubah_password()
    {
        $data = Profil::where('id', Auth::user()->id)->first();
        return view('/profil/ubah_password', compact('data'));
    }

    public function update_password(Request $request, $id)
    {
         $validator = Validator::make($request->all(), [
            'password' => 'required|password'
        ]);

        if ($validator->fails()) {
        return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }

        $check = Hash::check($request->password_lama, Auth::user()->password);

        if($check){
            if($request->password == $request->ulang_password){
                Profil::where('id', $id)->first()->update([
                    'password'=> Hash::make($request->password)
                    ]);

                return redirect('/profil')->withToastSuccess('Password berhasil diubah');    
            }else{
                return redirect('/profil/ubah_password')->withToastError('Password Baru Tidak Sama dengan Ulang Password');
            }
        }else{
            return redirect('/profil/ubah_password')->withToastError('Password Lama Salah');
        }
    }

}
