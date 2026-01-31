<?php

namespace App\Livewire\Karyawan;
use Illuminate\Support\Facades\Auth;
use App\Models\Karyawan;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class ProfilKaryawan extends Component
{
    use WithFileUploads;

    public $karyawan;
    public $newPhoto;

    // Kita menerima ID warga saat komponen dipanggil
    public function mount()
    {
        // Mencari data warga berdasarkan ID
        $id_user = Auth::user()->id_karyawan;
        $this->karyawan = Karyawan::findOrFail($id_user);
    }

    // Fungsi ini dipanggil saat tombol "Simpan Foto" ditekan
    public function updatePhoto()
    {
        // Validasi: Harus gambar & maksimal 2MB
        $this->validate([
            'newPhoto' => 'image|max:2048', 
        ]);

        // 1. Hapus foto lama jika ada (bukan default)
        if ($this->karyawan->file) {
            Storage::disk('public')->delete($this->karyawan->file);
        }

        // 2. Simpan foto baru ke folder 'foto-karyawan' di disk public
        $path = $this->newPhoto->store('foto-karyawan', 'public');

        // 3. Update database
        $this->karyawan->update(['file' => $path]);

        // 4. Reset variabel upload & beri notifikasi
        $this->reset('newPhoto');
        session()->flash('success', 'Foto profil berhasil diperbarui!');
    }

    public function render()
    {
        return view('livewire.karyawan.profil-karyawan');
    }
}
