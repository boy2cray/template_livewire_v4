<?php

namespace App\Livewire\Karyawan;
use Livewire\WithFileUploads;
use App\Models\Karyawan;
use Livewire\Component;

class TambahKaryawan extends Component
{
    use WithFileUploads;

    //variabel bindding
    public $nik, $nama, $jk='', $asal, $tgl_lahir, $alamat, $file;

    // Reset validasi dan data
    public function resetError()
    {
        $this->resetValidation();
        $this->reset(['nik', 'nama', 'jk', 'asal', 'tgl_lahir', 'alamat', 'file']);
    }

    public function mount()
    {
        $this->tgl_lahir = now()->format('Y-m-d');
    }

    protected function rules()
    {
        return [
            'nik'       => 'required|min:3|unique:karyawan,nik',
            'nama'      => 'required|string|max:50',
            'jk'        => 'required|in:L,P',
            'asal'      => 'required|string|max:30',
            'tgl_lahir' => 'required|date',
            'alamat'    => 'required|string|max:150',
            'file'      => 'nullable|image|max:2048',
        ];
    }

    public function tambahData()
    {
        $validasi = $this->validate();

        // Logika Upload File
        if ($this->file) {
            $path = $this->file->store('foto-karyawan', 'public');
            $validasi['file'] = $path;
        }

        // Simpan ke Database
        Karyawan::create($validasi);

        // Feedback & Reset
        $this->dispatch('notify', message: 'Data karyawan berhasil ditambahkan!', type: 'success');
        $this->dispatch('close-modal');
        $this->dispatch('data-ditambahkan'); // Untuk refresh table di parent
        
        $this->resetError();
    }

    public function render()
    {
        return view('karyawan.tambah-karyawan');
    }
}
