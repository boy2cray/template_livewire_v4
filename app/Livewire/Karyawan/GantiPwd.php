<?php

namespace App\Livewire\Karyawan;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\Hash; 

class GantiPwd extends Component
{
    public function resetError()
    {
        $this->resetValidation();
        $this->reset();
    }

    Public $id_user;

    public $password_old, $password, $password_confirmation;

    protected $rules = [
        'password_old' => 'required',
        'password' => 'required|min:3|confirmed'
    ];

    public function editPwd()
    {
        $valaidasi = $this->validate();

        $user = Auth::user();

        //Cek password lama
        if (!Hash::check($this->password_old, $user->password)) {
            $this->addError('current_password', 'Password lama yang Anda masukkan salah.');
            return;
        }

        //Update password
        $user->update([
            'password' => Hash::make($this->password)
        ]);

        $this->resetError();
        $this->dispatch('notify', message: 'Password dirubah...', type: 'success');
        $this->dispatch('close-modal');
       
    }

    public function render()
    {
        return view('livewire.karyawan.ganti-pwd');
    }
}
