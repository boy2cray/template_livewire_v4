<x-modal-input
    idModal='modalEdit'
    icon='edit'
    labelModal='Edit Data Karyawan'
    clickEvent='editData'
    buttonLabel='Edit'
    ukuran='max-w-2xl'
>

   <x-err-validation/>

    <x-floating-input
        wire:model="edit_nik"
        name="nik"
        label="NIK"
        icon="id"
    />

    <x-floating-input
        wire:model="edit_nama"
        name="nama"
        label="NAMA"
        icon="id"
    />

    <x-floating-input
        wire:model="edit_jk"
        name="jk"
        label="Jenis Kelamin"
        icon="venus-mars"
        type="select"
        :options="['L' => 'Laki-laki', 'P' => 'Perempuan']"
    />

    <x-floating-input
        wire:model="edit_asal"
        name="asal"
        label="Asal"
        icon="alamat"
    />

    <x-floating-input
        wire:model="edit_tgl_lahir"
        name="tgl_lahir"
        label="Tanggal Lahir"
        type="date"
        icon="kalender"
    />

    <x-floating-input
        wire:model="edit_alamat"
        name="alamat"
        label="Alamat"
        type="textarea"
        icon="alamat"
    />

    <div>
        @if ($oldFile && !$edit_file)
            <div class="mb-2">
                <p class="text-xs text-gray-500 dark:text-gray-400">Foto Saat Ini:</p>
                <img src="{{ Storage::url($oldFile) }}" class="h-24 w-24 object-cover rounded-lg border dark:border-gray-700">
            </div>
        @endif

        <x-file-upload 
            wire:model="edit_file" 
            label="Ganti Foto (Opsional)" 
            accept="image/png,image/jpeg" 
            maxSize="2" 
        />
    </div>


</x-modal-input>