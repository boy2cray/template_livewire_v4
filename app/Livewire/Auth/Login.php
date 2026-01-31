<?php

namespace App\Livewire\Auth;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Login extends Component
{
    #[Rule('required|email')]
    public $email = '';

    #[Rule('required')]
    public $password = '';

   
    public function login()
    {
        $credentials = $this->validate();

        if (Auth::attempt($credentials)) {
            session()->regenerate();

            $data_admin = Auth::user();
            $data_admin->load('karyawan');

            session()->put('id', $data_admin->id);
            session()->put('id_karyawan', $data_admin->id_karyawan);
            session()->put('email', $data_admin->email);
            session()->put('otoritas', $data_admin->otoritas);
            session()->put('nama', $data_admin->karyawan->nama);
            session()->put('foto', $data_admin->karyawan->file);
            
           
            return $this->redirect('/dashboard', navigate: true);
        }

        $this->addError('email', 'Email atau password yang Anda masukkan salah.');
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
