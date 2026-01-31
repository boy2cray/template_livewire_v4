<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Component;

class Register extends Component
{
    //bindding variable
    public $id_karyawan, $email, $password, $password_confirmation, $otoritas='user';

    protected $rules = [
        'id_karyawan' => 'required|integer|exists:karyawan,id|unique:users,id_karyawan',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:3|confirmed',
    ];

    protected $messages = [
        'id_karyawan.required' => 'ID karyawan wajib diisi.',
        'id_karyawan.integer'  => 'ID karyawan harus berupa angka.',
        'id_karyawan.exists'   => 'ID karyawan tidak ditemukan dalam tabel karyawan.',
        'id_karyawan.unique'   => 'ID karyawan sudah digunakan oleh user lain.',

        'email.required' => 'Email wajib diisi.',
        'email.email'    => 'Format email tidak valid.',
        'email.unique'   => 'Email sudah terdaftar.',

        'password.required'  => 'Password wajib diisi.',
        'password.string'    => 'Password harus berupa teks.',
        'password.min'       => 'Password minimal 3 karakter.',
        'password.confirmed' => 'Konfirmasi password tidak sesuai.',
    ];

    public function register()
    {
        $validasi = $this->validate();

        User::create([
            'id_karyawan' => $validasi['id_karyawan'],
            'email' => $validasi['email'],
            'password' => $validasi['password'],
            'otoritas' => $this->otoritas
        ]);

       
        return $this->redirect('/login', navigate: true);

    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
