<?php

namespace App\Http\Controllers\Admin;
use Auth;
use App\Helpers\Helper;
Use App\Setting;
use App\Http\Controllers\Controller;
use Response, Redirect;
use Illuminate\Http\Request;

class TaController extends Controller
{
    public function index()
    {
        $data = Setting::first();
        $back = Helper::back_button();
        $tombol= Helper::rekam('Update TA');
        return view('settings/referensi/ta/index', compact('data','back','tombol'));
    }
  
    public function update(Request $request, $id)
    {
        dd($id);
    }
}
