<?php

namespace App\Http\Controllers\User;

use Auth;
Use Alert;
Use \App\Pegawai;
Use \App\Honorer;
Use \App\Regsk;
Use \App\Regstugas;
use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $pegawai = Pegawai::where('status', 1)->where('aktif',1)->count(); 
        $honorer = Pegawai::where('status', 2)->count();
        $sk = Regsk::where('deleted_at', null)->count();
        $st = Regstugas::where('deleted_at', null)->count();
        return view('dashboard/index', compact('pegawai', 'honorer', 'sk','st'));
    }

    public function pegawai()
    {
        $data = Pegawai::where('status',1)->where('aktif',1)->whereNull('deleted_at')->orderBy('jabatan_id')->get();
        return view('dashboard/pegawai', ['data' => $data]);
    }
    
    public function honorer()
    {
        $data = Honorer::where('status',2)->whereNull('deleted_at')->get();
        return view('dashboard/honorer', ['data' => $data]);
    }
}
