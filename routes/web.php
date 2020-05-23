<?php

Route::get('login', function () {
    return view('layouts.login');
});

Auth::routes();

Route::group(['middleware' => ['auth', 'CheckRole:1']], function () {
    Route::group(
        ['namespace' => '\App\Http\Controllers\Admin'],
        function () {
            Route::resource('settings/menu', 'MenuController');
            Route::resource('settings/parent_menu', 'HeadmenuController');
            Route::resource('settings/pegawai', 'PegawaiController');
            Route::resource('settings/pramubhakti', 'HonorerController');
            Route::resource('settings/setting', 'SettingController');
            Route::get('settings', 'HeadmenuController@settings');
        }
    );
});

Route::group(['middleware' => ['auth', 'CheckRole:1,2']], function () {
    Route::group(['namespace' => '\App\Http\Controllers\User'], function () {
        Route::get('home', 'HomeController@index')->name('home');
        Route::resource('register/regsk', 'RegskController');
        Route::resource('register/kgb', 'RegkgbController');
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
