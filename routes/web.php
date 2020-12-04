<?php

Route::get('login', function () {
  return view('layouts.login');
});

Auth::routes();

Route::group(['middleware' => ['auth', 'CheckRole:1']], function () {
  Route::group(['namespace' => '\App\Http\Controllers\Admin'],
    function () {
      Route::resource('settings/menu', 'MenuController');
      Route::resource('settings/parent_menu', 'HeadmenuController');
      Route::get('settings/pegawai/trash', 'PegawaiController@trash');
      Route::resource('settings/pegawai', 'PegawaiController');
      Route::resource('settings/pramubhakti', 'HonorerController');
      Route::resource('daftar', 'DaftarController');
      Route::resource('settings/setting', 'SettingController');
      Route::resource('settings/database', 'DatabaseController');
      Route::get('settings', 'HeadmenuController@settings');
    }
  );
});

Route::group(['middleware' => ['auth', 'CheckRole:1,2']], function () {
	Route::group(['namespace' => '\App\Http\Controllers\User'], 
		function () {
      Route::get('dashboard', 'HomeController@index');
      Route::get('dashboard/pegawai', 'HomeController@pegawai');
      Route::get('dashboard/pegawai_nonaktif', 'HomeController@pegawai_nonaktif');
      Route::get('dashboard/honorer', 'HomeController@honorer');
      Route::get('dashboard/daftarsk/{id}', 'HomeController@daftarsk');
      Route::resource('log', 'LogController');
      Route::resource('register/regsk', 'RegskController');
      Route::post('register/kgb/print/{id}', 'RegkgbController@print');
      Route::resource('register/kgb', 'RegkgbController');
      Route::get('register/kgb/{id}/hasil', 'RegkgbController@get_data');
      Route::resource('register/sop', 'RegsopController');
      Route::resource('register/surat_cuti', 'RegcutiController');
      Route::post('register/surat_cuti/print/{id}', 'RegcutiController@print');
      Route::resource('register/surat_tugas', 'RegstugasController');
      Route::post('register/surat_tugas/print/{id}', 'RegstugasController@print');
      Route::get('profil/ubah_password', 'ProfilController@ubah_password');
      Route::resource('profil', 'ProfilController');
      Route::patch('profil/update_password/{id}', 'ProfilController@update_password');
    });
  Route::post('logout', 'Auth\LoginController@logout');
});
