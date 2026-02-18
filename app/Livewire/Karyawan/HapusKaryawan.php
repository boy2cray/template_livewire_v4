<?php

namespace App\Livewire\Karyawan;
use Illuminate\Support\Facades\Gate;
use App\Models\Karyawan;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Livewire\Traits\WithAlert;

class HapusKaryawan extends Component
{
    use WithAlert;

    public function resetError()
    {
        $this->resetValidation();
        $this->reset();
    }

    // Properti untuk menampung ID data
    public ?int $dataId = null;

    //variabel bindding
    public $hapus_nik,$hapus_nama, $file_hapus;

    #[On('load_data_hapus')]
    public function loadData($id)
    {
        $data = Karyawan::findOrFail($id);

        if ($data)
        {
            $this->dataId = $data->id;
            $this->hapus_nik = $data->nik;
            $this->hapus_nama = $data->nama;
            $this->file_hapus = $data->file;
        
            // Kirim event ke Alpine.js untuk MEMBUKA modal
            $this->dispatch('tampil-hapus-modal');
        }
    }

    public function hapusData()
    {
        //validasi gerbang
        if (Gate::denies('kelola-database-utama')) {
            $this->alert('error', 'Anda tidak memiliki kewenangan');
            return;
        }
        
        Karyawan::findOrFail($this->dataId)->delete();

        //hapus juga file foto
        delete_file($this->file_hapus);
        
        //Kirim event
        $this->alert('success', 'Data karyawan berhasil dihapus');
        $this->dispatch('refresh-table');
        $this->dispatch('close-hapus-modal');

        $this->resetError();
    }

    public function render()
    {
        return view('karyawan.hapus-karyawan');
    }
}
