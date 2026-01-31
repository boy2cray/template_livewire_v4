<?php

namespace App\Livewire\Admin;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class HapusAdmin extends Component
{
    public function resetError()
    {
        $this->resetValidation();
        $this->reset();
    }

    // Properti untuk menampung ID data
    public ?int $dataId = null;

    //variabel bindding
    public $hapus_nama,$hapus_email;

    #[On('load_data_hapus')]
    public function loadData($id)
    {
        $data = User::findOrFail($id);
        $data->with('karyawan');

        if ($data)
        {
            $this->dataId = $data->id;
            $this->hapus_nama = $data->karyawan->nama;
            $this->hapus_email = $data->email;
        
            // Kirim event ke Alpine.js untuk MEMBUKA modal
            $this->dispatch('tampil-hapus-modal');
        }
    }

    public function hapusData()
    {
        //validasi gerbang
        if (Gate::denies('kelola-database-utama')) {
            $this->dispatch('show-alert', message: 'Anda tidak memiliki kewenangan...', type: 'error');
            return;
        }

        //cegah menghapus diri sendiri
        if (Auth::id() == $this->dataId)
        {
            $this->dispatch('show-alert',message: 'Anda tidak bisa menghapus akun anda sendiri...', type: 'error');
            return;
        }
        
        $data = User::findOrFail($this->dataId)->delete();
        
        //Kirim event
        $this->resetError();
        $this->dispatch('notify', message: 'Data berhasil dihapus...', type: 'success');
        $this->dispatch('data-diubah');
        $this->dispatch('close-hapus-modal');
    }

    public function render()
    {
        return view('livewire.admin.hapus-admin');
    }
}
