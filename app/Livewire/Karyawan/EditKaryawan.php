<?php

namespace App\Livewire\Karyawan;

use App\Models\Karyawan;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Gate;
use App\Livewire\Traits\WithAlert;

class EditKaryawan extends Component
{
    use WithAlert;
    use WithFileUploads;

    public function resetError()
    {
        $this->resetValidation();
        $this->reset();
    }

    // Properti untuk menampung ID data
    public ?int $dataId = null;

    //variabel bindding
    public $edit_nik,$edit_nama, $edit_jk, $edit_asal, $edit_tgl_lahir, $edit_alamat, $edit_file;
    public $oldFile; // Menyimpan path foto lama

    #[On('load_data_edit')]
    public function loadData($id)
    {
        $data = Karyawan::find($id);

        if ($data)
        {
            $this->dataId = $data->id; 
            $this->edit_nik = $data->nik;
            $this->edit_nama= $data->nama;
            $this->edit_jk= $data->jk;
            $this->edit_asal = $data->asal;
            $this->edit_tgl_lahir = \Carbon\Carbon::parse($data->tgl_lahir)->format('Y-m-d');
            $this->edit_alamat = $data->alamat;
            $this->oldFile = $data->file;
            $this->dispatch('tampil-edit-modal');
        }

    }

    protected function rules()
    {
        return [
            // NIK unik, tapi abaikan ID karyawan yang sedang diedit
            'edit_nik'       => 'required|min:3|unique:karyawan,nik,' . $this->dataId,
            'edit_nama'      => 'required|string|max:50',
            'edit_jk'        => 'required|in:L,P',
            'edit_asal'      => 'required|string|max:30',
            'edit_tgl_lahir' => 'required|date',
            'edit_alamat'    => 'required|string|max:150',
            'edit_file'      => 'nullable|image|max:2048',
        ];
    }

    public function editData()
    {
        //validasi gerbang
        if (Gate::denies('kelola-database-utama')) {
            $this->alert('error', 'Anda tidak memiliki kewenangan');
            return;
        }
        
        $validasi = $this->validate();
        $karyawan = Karyawan::findOrFail($this->dataId);

        // Logika File Foto
        // Logika File Foto
        $newFile = update_file($this->edit_file, $this->oldFile, 'foto-karyawan');

        $karyawan->update([
            'nik' => $validasi['edit_nik'],
            'nama' => $validasi['edit_nama'],
            'jk' => $validasi['edit_jk'],
            'asal' => $validasi['edit_asal'],
            'tgl_lahir' => $validasi['edit_tgl_lahir'],
            'alamat' => $validasi['edit_alamat'],
            'alamat' => $validasi['edit_alamat'],
            'file' => $newFile,
        ]);

        //kirim event
        $this->alert('success', 'Data karyawan berhasil diubah');
        $this->dispatch('close-edit-modal');
        $this->dispatch('refresh-table'); // Untuk refresh table di parent
        
        $this->resetError();
    }

    public function render()
    {
        return view('karyawan.edit-karyawan');
    }
}
