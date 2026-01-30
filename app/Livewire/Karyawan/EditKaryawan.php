<?php

namespace App\Livewire\Karyawan;

use App\Models\Karyawan;
use Livewire\Attributes\On;
use Livewire\Component;

class EditKaryawan extends Component
{
    public function resetError()
    {
        $this->resetValidation();
        $this->reset();
    }

    // Properti untuk menampung ID data
    public ?int $dataId = null;

    //variabel bindding
    public $edit_nik,$edit_nama, $edit_jk, $edit_asal, $edit_tgl_lahir, $edit_alamat;

    #[On('load_data_edit')]
    public function loadData($id)
    {
        $data = Karyawan::find($id);

        if ($data)
        {
            $this->dataId = $data->id; 
            $this->edit_nama= $data->nama;
            $this->edit_jk= $data->jk;
            $this->edit_asal = $data->asal;
            $this->edit_tgl_lahir = $data->tgl_lahir;
            $this->edit_alamat = $data->alamat;
            $this->dispatch('tampil-edit-modal');
        }

    }

    public function render()
    {
        return view('karyawan.edit-karyawan');
    }
}
