<?php

namespace App\Http\Controllers\User;

use Auth;
Use Alert;
use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        //  Alert::toast('Selamat Datang', 'success')->background('#eee');
         Alert::alert()->success('Post Created', 'Successfully')->toToast()->background('#eee');
        return view('home');
    }

    public function userlist()
    {
        $data = User::all();
        return view('user_list', ['data' => $data]);
    }
}
