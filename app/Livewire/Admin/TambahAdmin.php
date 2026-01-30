<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

class TambahAdmin extends Component
{
    public function resetError()
    {
        $this->resetValidation();
        $this->reset();
    }

    //bindding variable
    public $id_karyawan, $email, $password, $password_confirmation, $otoritas='';

    protected $rules = [
        'id_karyawan' => 'required|integer|exists:karyawan,id|unique:users,id_karyawan',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:3|confirmed',
        'otoritas' => 'required|string|in:su,admin'
    ];

    //pesan error validasi custom
    protected $messages = [
        'id_karyawan.required' => 'ID karyawan belum terisi.',
        'id_karyawan.exists' => 'Data karyawan tidak ditemukan',
        'id_karyawan.unique' => 'karyawan sudah memiliki akun.',

        'email.required' => 'Email wajib terisi.',
        'password.required' => 'Password wajib terisi.',
        'otoritas.required' => 'Otoritas wajib dipilih.',
    ];

    public function tambahData()
    {

        $validasi = $this->validate();

        User::create([
            'id_karyawan' => $validasi['id_karyawan'],
            'email' => $validasi['email'],
            'password' => $validasi['password'],
            'otoritas' => $validasi['otoritas']
        ]);

        //kirim event
        $this->resetError();
        $this->dispatch('notify', message: 'Penambahan data berhasil...', type: 'success');
        $this->dispatch('close-modal');
        $this->dispatch('data-ditambahkan');

    }

    public function render()
    {
        return view('livewire.admin.tambah-admin');
    }
}
