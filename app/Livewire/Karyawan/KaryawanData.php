<?php

namespace App\Livewire\Karyawan;

use App\Models\Karyawan;
use App\Traits\WithBaseTable; // Import trait manual Anda
use Livewire\Component;
use Livewire\Attributes\On;

class KaryawanData extends Component
{
    use WithBaseTable; // Gunakan trait di sini

    //Metode untuk menagkap event dari area lain
    #[On('data-ditambahkan')] 
    #[On('data-diubah')] 
    public function refreshTabel()
    {
        //fungsi untuk memancing refresh
    }

    //Fungsi untuk mengisikan parameter tabel
    public function mount()
    {
        $this->search_type='text';

        $this->headers = [
            ['key' => null, 'label' => '#'],
            ['key' => 'file', 'label' => 'Foto', 'skey' => 'file'],
            ['key' => 'nik', 'label' => 'NIK','skey' => 'nik'],
            ['key' => 'nama', 'label' => 'Nama','skey' => 'nama'],
            ['key' => 'jk', 'label' => 'Jenis Kelamin','skey' => 'jk'],
            ['key' => 'asal', 'label' => 'Asal','skey' => 'asal'],
            ['key' => 'tgl_lahir', 'label' => 'Tgl lahir','skey' => 'tgl_lahir'],
            ['key' => 'alamat', 'label' => 'Alamat','skey' => 'alamat'],
            ['key' => null, 'label' => 'Aksi'],
        ];

    }

    //Fungsi untuk menampilkan modal edit
    Public function tampilEdit($id)
    {
        $this->dispatch('load_data_edit', id: $id);
    }

    //Fugsi untuk menampilkan modal hapus
    public function tampilHapus($id)
    {
        $this->dispatch('load_data_hapus', id: $id);
    }

    public function render()
    {
        //Sesuaikan dengan query select
        $_data = Karyawan::query();
        $_data->select(
            'id',
            'nik',
            'nama',
            'jk',
            'asal',
            'tgl_lahir',
            'asal',
            'alamat',
            'file',
            );

        if($this->search)
        {
            $search = $this->search;
            $_data->where(function ($q) use ($search) {
                $q->where('nik', 'like', "%{$search}%")
                ->orWhere('nama','like',"%{$search}%");
            });
        }

        $_data->orderBy($this->sortBy, $this->sortDir);

        return view('livewire.part.view-table',[
            'konten' => $_data->paginate($this->perPage)->onEachSide(2),
        ]);
    }
}
