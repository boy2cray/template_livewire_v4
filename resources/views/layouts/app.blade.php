<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="color-scheme" content="dark light">
    <title>@yield('title', 'Admin Dashboard') - Unik</title>

    {{-- SCRIPT DARKMODE --}}
    <script>
        function updateTheme() {
            if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        }
        updateTheme();
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
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        [x-cloak] { display: none !important; }
    
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        @keyframes fade-in { from { opacity: 0; transform: translateY(5px); } to { opacity: 1; transform: translateY(0); } }
        .animate-fade-in { animation: fade-in 0.3s ease-out; }
    </style>

    @livewireStyles
    
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal dark:bg-gray-900 dark:text-gray-100 transition-colors duration-300">

    <div x-data="{ sidebarOpen: false, isSidebarPinned: true, isSidebarHovered: false, searchTerm: '' }" x-cloak>
        
        {{-- Loader --}}
        <div id="page-loader" class="absolute inset-0 items-center justify-center z-50 bg-gray-100/75 backdrop-blur-sm hidden dark:bg-gray-900/75">
            <div class="animate-spin rounded-full h-10 w-10 border-4 border-blue-500 border-t-transparent"></div>
        </div>
        
        {{-- Sidebar --}}
        @include('layouts.partials.sidebar')

        {{-- Wrapper untuk Konten Utama + Header --}}
        <div class="relative flex-1 flex flex-col transition-all duration-300 ease-in-out" 
            :class="{
                'md:ml-64': isSidebarPinned || isSidebarHovered,
                'md:ml-20': !isSidebarPinned && !isSidebarHovered,
                'translate-x-64': sidebarOpen
            }">

            {{-- Header halaman --}}
            @include('layouts.partials.header')

            {{-- Konten Utama --}}
            <main class="flex-1 p-6">
                @yield('content')
            </main>

            {{-- Footer --}}
            <footer class="w-full p-4 text-center text-sm text-gray-500 dark:text-gray-400 mt-auto border-t border-gray-200 dark:border-gray-700">
                &copy; {{ date('Y') }} ARTEK Dashboard. Created By: Eko_Teknik.
            </footer>

        </div>
    </div>

    @include('layouts.partials.script')

    {{-- Livewire Scripts --}}
    @livewireScripts

    @stack('scripts')

</body>
</html>