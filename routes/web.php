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
            Route::get('settings', 'HeadmenuController@settings');
        }
    );
    Route::get('json', 'HomeController@json');
});

Route::group(['middleware' => ['auth', 'CheckRole:1,2']], function () {
    Route::group(['namespace' => '\App\Http\Controllers\User'], function () {
        Route::get('home', 'HomeController@index')->name('home');
        Route::resource('register/regsk', 'RegskController');
        Route::resource('register/kgb', 'RegkgbController');
        Route::resource('register/sop', 'RegsopController');
        Route::resource('register/surat_cuti', 'RegcutiController');
        Route::resource('register/surat_tugas', 'RegstugasController');
    });
    Route::get('user_list', 'HomeController@userlist');
    Route::post('logout', 'Auth\LoginController@logout');
});
