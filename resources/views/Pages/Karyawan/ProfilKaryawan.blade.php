@extends('layouts.app')

@section('title', 'Profil')

@section('content')
<div x-data="{ modalPwd : false ,
            }"
    @close-modal.window="modalPwd = false"
>

    @livewire('karyawan.profil-karyawan')

    {{-- Modal --}}
    @livewire('karyawan.ganti-pwd')
    

</div>

@endsection