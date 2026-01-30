<x-modal-input
    idModal='modalTambah'
    icon='plus'
    labelModal='Tambah Data Admin'
    clickEvent='tambahData'
    buttonLabel='Tambah'
    ukuran='max-w-2xl'
>

   <x-err-validation/>

    <livewire:part.search-select 
        wire:model="id_karyawan" 
        model="App\Models\Karyawan" 
        searchField="nama" 
        valueField="id"
        kodeField="nik" 
        labelField="Nama Karyawan" 
        placeholder="Cari Karyawan..."
    />

    <x-floating-input
        wire:model="email"
        name="email"
        label="Akun/Email"
        type="email"
        icon="email"
    />

    <x-floating-input
        wire:model="password"
        name="password"
        label="Password"
        type="password"
        icon="kunci"
    />

    <x-floating-input
        wire:model="password_confirmation"
        name="password_confirmation"
        label="Konfirmasi Password"
        type="password"
        icon="kunci"
    />

    <x-floating-input
        name="otoritas"
        wire:model="otoritas"
        label="Otoritas"
        icon="id"
        type="select"
        :options="['su' => 'Superuser', 'admin' => 'Admin', 'user' => 'User']"
    />

</x-modal-input>