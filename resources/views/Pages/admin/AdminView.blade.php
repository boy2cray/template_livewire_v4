@extends('layouts.app')

@section('title', 'Data Admin')

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
        title='Data Admin'
        description='halaman berisi informasi data admin'
        :addbutton=true
    />

    {{-- TABEL UTAMA --}}
    @livewire('admin.admin-data')
    
    {{-- MODAL --}}
    @livewire('admin.tambah-admin')
    @livewire('admin.edit-admin')
    @livewire('admin.hapus-admin')
    
    
</div>

@endsection