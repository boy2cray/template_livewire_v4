@extends('layouts.app')

@section('title', 'Data Karyawan')

@section('content')

<div x-data="{ modalTambah : false ,
                modalEdit : false,
                modalHapus : false,
                modalImport : false,
            }"
            @close-modal.window="modalTambah = false"
            @close-edit-modal.window="modalEdit = false"
            @tampil-edit-modal.window="modalEdit = true"
            @close-hapus-modal.window="modalHapus = false"
            @tampil-hapus-modal.window="modalHapus = true"
            @close-modal-import.window="modalImport = false"     
        >

    <x-headerHalaman
        title='Data Karyawan'
        description='halaman berisi informasi data karyawan'
        :addbutton=true
        :showImport=true
    />

    {{-- TABEL UTAMA --}}
    @livewire('karyawan.karyawan-data')
    
    {{-- MODAL --}}
    @livewire('karyawan.tambah-karyawan')
    @livewire('karyawan.edit-karyawan')
    @livewire('karyawan.hapus-karyawan')
    @livewire('karyawan.import-karyawan')
    
</div>



@endsection