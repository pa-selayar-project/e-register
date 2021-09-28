<?php

namespace App\Http\Controllers\Admin;

use App\Daftar;
use App\Pegawai;
use App\Level;
use App\Log;
use App\Helpers\Helper;
use Auth;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Response, Redirect;

class DaftarController extends Controller
{
    
	public function index()
	{
			$users = Daftar::all();
			$pgw = Pegawai::whereUser(0)->orderBy('jabatan_id')->get();
			$back = Helper::back_button();
			$tombol= Helper::rekam('Tambah User');
			return view('daftar/index', compact('users','pgw','tombol','back'));
	}

  public function store(Request $request)
	{
		$messages = [
			'email.required'=>'Email harus diisi',
			'email.unique'=>'Email Sudah Ada'
		]; 
			$request->validate([
      'email' => 'required|unique:users|email',
			], $messages);

			$data = Pegawai::findOrFail($request->pgw);

			Daftar::create([
					'name' => $data->nip,
					'id_pegawai' => $data->id,
          'email' => $request->email,
          'password' => Hash::make('123'),
          'id_level' => 3,
          'image' => $data->foto
			]);

			$data->update(['user'=> 1]);
			
			Log::create([
			'user_id' => Auth::user()->id,
			'pesan_Log' => 'Menambahkan User'
			]);

			return redirect('daftar')->with('message', 'Input User berhasil');
	}

	public function show(Daftar $daftar)
	{
			$log_act = Log::whereUserId($daftar->id)->get();
			$data = (object)[
				'nama'=>$daftar->name,
				'email'=>$daftar->email,
				'level'=>$daftar->id_level,
				'foto'=>$daftar->image,
				'log'=> count($log_act),
				'join'=>Helper::tanggal_id(strtotime($daftar->created_at)),
			];
			
			$back = Helper::back_button();
			return view('daftar/show', compact('data','back')); 
	}

	public function edit(Daftar $daftar)
	{
		$level = Level::all();
		return view('daftar/edit', compact('daftar','level'));
	}

	public function update(Request $request, Daftar $daftar)
	{
		$messages = [
			'name.required'=>'Nama Harus diisi',		
			'email.required'=>'Email harus diisi',
		]; 

		$request->validate([
      'name' => 'required',
      'email' => 'required|email',
			], $messages);

		$daftar->update([
			'name' => $request->name,
			'email' => $request->email,
			'id_level' => $request->level
		]);
		
		Log::create([
			'user_id' => Auth::user()->id,
			'pesan_Log' => 'Mengedit User'
		]);

		return redirect('daftar')->with('message', 'Input User berhasil');
	}

	public function destroy($id)
	{
		Daftar::destroy($id);
		Log::create([
			'user_id' => Auth::user()->id,
			'pesan_Log' => 'Menghapus User'
		]);
		return back()->with('toast_success', 'Data berhasil dihapus!');
	}
}
