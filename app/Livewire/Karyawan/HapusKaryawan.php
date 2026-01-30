<?php

namespace App\Livewire\Karyawan;

use App\Models\Karyawan;
use Livewire\Attributes\On;
use Livewire\Component;

class HapusKaryawan extends Component
{
    public function resetError()
    {
        $this->resetValidation();
        $this->reset();
    }

    // Properti untuk menampung ID data
    public ?int $dataId = null;

    //variabel bindding
    public $hapus_nik,$hapus_nama;

    #[On('load_data_hapus')]
    public function loadData($id)
    {
        $data = Karyawan::findOrFail($id);

        if ($data)
        {
            $this->dataId = $data->id;
            $this->hapus_nik = $data->nik;
            $this->hapus_nama = $data->nama;
        
            // Kirim event ke Alpine.js untuk MEMBUKA modal
            $this->dispatch('tampil-hapus-modal');
        }
    }

    public function hapusData()
    {
        
        $data = Karyawan::findOrFail($this->dataId)->delete();
        
        //Kirim event
        $this->resetError();
        $this->dispatch('notify', message: 'Data berhasil dihapus...', type: 'success');
        $this->dispatch('data-diubah');
        $this->dispatch('close-hapus-modal');
    }

    public function render()
    {
        return view('karyawan.hapus-karyawan');
    }
}
