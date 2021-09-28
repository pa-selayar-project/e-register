<?php

namespace App\Http\Controllers\User;

use App\Profil;
use App\Log;
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
		$data = Profil::findOrFail(Auth::user()->id);
		return view('profil/index', compact('data'));
	}

	public function edit($id)
	{
		$data = Profil::findOrFail($id);
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
			return Redirect::back()->withToastError($validator->messages()->all()[0])->withInput();
		}

		$update = Profil::findOrFail($id);

		$update->update([
			'name' => $request->name,
			'email' => $request->email
		]);

		if ($request->hasFile('image')) {
			$file     = $request->file('image');
			$ext      = $file->getClientOriginalExtension();
			$image    = 'user_' . uniqid() . '.' . $ext;
			$file->storeAs('pic', $image);
			if ($update->image !== 'user.png') {
				Storage::delete('pic/' . $update->image);
			}
			$update->update(['image' => $image]);
		}

		Log::create([
			'user_id' => Auth::user()->id,
			'pesan_Log' => 'Mengedit Profilnya'
		]);

		return redirect('/profil')->withToastSuccess('Data berhasil diubah');
	}

	public function ubah_password()
	{
		$data = Profil::findOrFail(Auth::user()->id);
		return view('/profil/ubah_password', compact('data'));
	}

	public function update_password(Request $request, $id)
	{
		$messages = [
								'required'=>'Kolom ini harus diisi!'
							];
		
		$request->validate([
			'password_lama' => 'required',
			'password' => 'required',
			'ulang_password' => 'required',
		], $messages);

		$check = Hash::check($request->password_lama, Auth::user()->password);

		if ($check) {
			if ($request->password == $request->ulang_password) {
				Profil::findOrFail($id)->update([
					'password' => Hash::make($request->password)
				]);
				Log::create([
					'user_id' => Auth::user()->id,
					'pesan_Log' => 'Merubah Passwordnya'
				]);

				return redirect('/profil')->withToastSuccess('Password berhasil diubah');
			} else {
				return redirect('/profil/ubah_password')->withToastError('Password Baru Tidak Sama dengan Ulang Password');
			}
		} else {
			return redirect('/profil/ubah_password')->withToastError('Password Lama Salah');
		}
	}
}
