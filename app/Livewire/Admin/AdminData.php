<?php

namespace App\Livewire\Admin;

use App\Models\User;
use App\Traits\WithBaseTable;
use Livewire\Component;
use Livewire\Attributes\On;

class AdminData extends Component
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
            ['key' => 'file', 'label' => 'Foto','skey' => 'karyawan.foto'],
            ['key' => 'nama', 'label' => 'Nama','skey' => 'karyawan.nama'],
            ['key' => 'email', 'label' => 'Email','skey' => 'users.email'],
            ['key' => 'otoritas', 'label' => 'Otoritas','skey' => 'users.otoritas'],
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

    //reset paginasi ketika search di update
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        //Sesuaikan dengan query select
        $_data = User::query();
        $_data->join('karyawan','users.id_karyawan','=','karyawan.id');
        $_data->select(
            'users.id',
            'karyawan.nama',
            'users.email',
            'users.otoritas',
            'karyawan.file'
        );

        if($this->search)
        {
            $search = $this->search;
            $_data->where(function ($q) use ($search) {
                $q->where('karyawan.nama', 'like', "%{$search}%");
            });
        }

        $_data->orderBy($this->sortBy, $this->sortDir);
        
        return view('livewire.part.view-table',[
            'konten' => $_data->paginate($this->perPage)->onEachSide(1),
        ]);
    }
   
}
