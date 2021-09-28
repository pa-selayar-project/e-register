<?php

namespace App\Http\Controllers\Admin;

use App\Setting;
use App\Helpers\Helper;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Response, Redirect;

class SettingController extends Controller
{
	public function index()
	{
		$data = Setting::findOrFail(1);
		$back = Helper::back_button();
		return view('settings/setting/index', compact('data','back'));
	}

	public function edit(Setting $setting)
	{
		$data = $setting;
		$back = Helper::back_button();
		return view('settings/setting/edit', compact('data','back'));
	}

	public function update(Request $request, Setting $setting)
	{
		$setting->update($this->validateRequest());

		if($request->hasFile('logo_besar')){
			$file     = $request->file('logo_besar');
			$ext      = $file->getClientOriginalExtension();
			$image    = 'logo_'.uniqid().'.'.$ext;
			$file->storeAs('images/logo', $image);
			Storage::delete('images/logo'.$setting->logo_besar);
			
			$setting->update(['logo_besar'=> $image]);
		}

		if($request->hasFile('bgimage')){
			$file     = $request->file('bgimage');
			$ext      = $file->getClientOriginalExtension();
			$image    = 'logo_'.uniqid().'.'.$ext;
			$file->storeAs('images/logo', $image);
			Storage::delete('images/logo'.$setting->bgimage);
			
			$setting->update(['bgimage'=> $image]);
		}

		if($request->hasFile('logo_kecil')){
			$file     = $request->file('logo_kecil');
			$ext      = $file->getClientOriginalExtension();
			$image    = 'logo_'.uniqid().'.'.$ext;
			$file->storeAs('images/logo', $image);
			Storage::delete('images/logo'.$setting->logo_kecil);
			
			$setting->update(['logo_kecil'=> $image]);
		}

		return Redirect::back()->with('message','Data berhasil diubah');
	}

	private function validateRequest()
	{
		$messages = [
			'required' => 'Kolom Wajib Diisi!',
			'max'=>'Ukuran file terlalu besar (max 1Mb)',
			'mimes'=>'Tipe File harus jpg,bmp atau png',
			'image'=>'Tipe file harus gambar'
		];

		return request()->validate([
			'nama_aplikasi' => 'required',
      'versi' => 'required',
      'bgimage' => 'image|mimes:jpeg,jpg,bmp,png|max:1024',
      'author' => 'required',
      'logo_besar' => 'image|mimes:jpeg,jpg,bmp,png|max:1024',
      'logo_kecil' => 'image|mimes:jpeg,jpg,bmp,png|max:1024'
		], $messages);
	}
}
