<?php

namespace App\Http\Controllers\User;

use Auth;
use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function userlist()
    {
        $data = User::all();
        return view('user_list', ['data' => $data]);
    }
}
