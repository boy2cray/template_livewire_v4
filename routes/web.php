<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('beranda.dashboard');
});

Route::get('/dashboard', function () {
    return view('beranda.dashboard');
});

Route::get('/karyawan', function () {
    return view('Pages.Karyawan.KaryawanView');
});

Route::get('/admin', function () {
    return view('Pages.admin.AdminView');
});