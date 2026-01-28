<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Unik</title>

    {{-- SCRIPT DARK MODE YANG DIPERBAIKI --}}
    <script>
        // 1. Definisikan fungsi untuk set tema
        function updateTheme() {
            // Cek localStorage atau Preferensi Sistem
            if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        }

        // 2. Jalankan saat pertama kali load
        updateTheme();

        // 3. PENTING: Jalankan ulang setiap kali Livewire selesai navigasi
        document.addEventListener('livewire:navigated', () => {
            updateTheme();
        });
    </script>

    {{-- import style tailwind --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- font awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    {{-- sweetalert 2 notifikasi --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- Livewire Styles --}}
    @livewireStyles

    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>

{{-- 2. UPDATE BODY: Tambahkan dark:bg-gray-900 dan dark:text-gray-100 --}}
<body class="bg-gray-100 font-sans leading-normal tracking-normal dark:bg-gray-900 dark:text-gray-100 transition-colors duration-300">

    <div x-data="{ sidebarOpen: false, isSidebarPinned: true, isSidebarHovered: false, searchTerm: '' }" x-cloak>
        {{-- Sidebar --}}
        @include('layouts.partials.sidebar')

        {{-- Wrapper untuk Konten Utama + Header --}}
        <div class="relative flex-1 flex flex-col transition-all duration-300 ease-in-out" 
            :class="{
                'md:ml-64': isSidebarPinned || isSidebarHovered,
                'md:ml-20': !isSidebarPinned && !isSidebarHovered,
                'translate-x-64': sidebarOpen
            }">

            {{-- 3. UPDATE LOADER: Tambahkan dark:bg-gray-900/75 agar loader juga gelap --}}
            <div id="page-loader" class="absolute inset-0 items-center justify-center z-50 bg-gray-100/75 backdrop-blur-sm hidden dark:bg-gray-900/75">
                <div class="animate-spin rounded-full h-10 w-10 border-4 border-blue-500 border-t-transparent"></div>
            </div>

            {{-- Header halaman --}}
            @include('layouts.partials.header')

            {{-- Konten Utama --}}
            <main class="flex-1 p-6">
                @yield('content')
            </main>

        </div>
    </div>

    @include('layouts.partials.script')

    {{-- Livewire Scripts --}}
    @livewireScripts

    @stack('scripts')

</body>
</html>