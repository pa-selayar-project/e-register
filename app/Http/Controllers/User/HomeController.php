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
        return view('home');
    }
}
