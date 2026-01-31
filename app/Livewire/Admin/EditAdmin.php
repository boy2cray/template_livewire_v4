<?php

namespace App\Livewire\Admin;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class EditAdmin extends Component
{
    public function resetError()
    {
        $this->resetValidation();
        $this->reset();
    }

     // Properti untuk menampung ID data
    public ?int $dataId = null;

    //bindding variabel
    public $edit_nama, $edit_email, $edit_password, $edit_password_confirmation, $edit_otoritas;

    #[On('load_data_edit')]
    public function loadData($id)
    {
        $data = User::findOrFail($id);
        $data->with('karyawan');

        if ($data)
        {
            $this->dataId = $data->id; 
            $this->edit_nama = $data->karyawan->nama;
            $this->edit_email = $data->email;
            $this->edit_otoritas= $data->otoritas;
        
            // Kirim event ke Alpine.js untuk MEMBUKA modal
            $this->dispatch('tampil-edit-modal');
        }

    }

    protected function rules()
    {
        return [
            'edit_otoritas' => 'required|string|in:su,admin',
            'edit_password' => 'confirmed'
        ];
    }

    public function editData()
    {
        if (Gate::denies('kelola-database-utama')) {
            $this->dispatch('show-alert', message: 'Anda tidak memiliki kewenangan...', type: 'error');
            return;
        }
        
        $validasi = $this->validate();

        $data = User::findOrFail($this->dataId);
        //jika password tidak kosong update password
        if ($this->edit_password)
        {
            $data->update(['password' => $validasi['edit_password']]);
        }

        $data->update(['otoritas' => $validasi['edit_otoritas']]);

        //kirim event
        $this->resetError();
        $this->dispatch('notify', message: 'Update data berhasil...', type: 'success');
        $this->dispatch('data-diubah');
        $this->dispatch('close-edit-modal');
    }


    public function render()
    {
        return view('livewire.admin.edit-admin');
    }
}
