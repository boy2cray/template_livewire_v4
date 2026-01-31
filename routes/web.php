<?php

use Illuminate\Support\Facades\Route;

Route::get('/login',function() {return view('pages.auth.login');})->name('login');
Route::get('/register',function() {return view('pages.auth.register');})->name('register');
Route::redirect('/', '/login');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {return view('beranda.dashboard');});

    Route::get('/karyawan',function() {return view('Pages.Karyawan.KaryawanView');})->name('data.karyawan');
    Route::get('/admin',function() {return view('Pages.admin.AdminView');})->name('data.admin');
    Route::get('/profil',function() {return view('Pages.Karyawan.ProfilKaryawan');})->name('profil.karyawan');

});