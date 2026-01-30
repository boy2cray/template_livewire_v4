<x-modal-input
    idModal='modalTambah'
    icon='plus'
    labelModal='Tambah Data Karyawan'
    clickEvent='tambahData'
    buttonLabel='Tambah'
    ukuran='max-w-2xl'
>

   <x-err-validation/>

    <x-floating-input
        wire:model="nik"
        name="nik"
        label="NIK"
        icon="id"
    />

    <x-floating-input
        wire:model="nama"
        name="nama"
        label="NAMA"
        icon="id"
    />

    <x-floating-input
        wire:model="jk"
        name="jk"
        label="Jenis Kelamin"
        icon="venus-mars"
        type="select"
        :options="['L' => 'Laki-laki', 'P' => 'Perempuan']"
    />

    <x-floating-input
        wire:model="asal"
        name="asal"
        label="Asal"
        icon="alamat"
    />

    <x-floating-input
        wire:model="tgl_lahir"
        name="tgl_lahir"
        label="Tanggal Lahir"
        type="date"
        icon="kalender"
    />

    <x-floating-input
        wire:model="alamat"
        name="alamat"
        label="Alamat"
        type="textarea"
        icon="alamat"
    />

    <x-file-upload
        wire:model="file" 
        label="Pas Foto Karyawan" 
        accept="image/png,image/jpeg" 
        maxSize="2"
    />

</x-modal-input>