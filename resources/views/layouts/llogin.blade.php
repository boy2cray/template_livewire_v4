<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Unik</title>

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


    @vite(['resources/css/app.css', 'resources/js/app.js']) 
    {{-- font awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    @livewireStyles
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal dark:bg-gray-900 dark:text-gray-100 transition-colors duration-300">

    <!-- Tombol Toggle Dark Mode -->
    <div 
        class="fixed top-6 right-6 z-50 sm:top-5 sm:right-5"
        x-data="{ 
            darkMode: localStorage.theme === 'dark' || 
                    (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches) 
        }"
    >
        <button 
            @click="
                darkMode = !darkMode; 
                if (darkMode) {
                    localStorage.theme = 'dark';
                    document.documentElement.classList.add('dark');
                } else {
                    localStorage.theme = 'light';
                    document.documentElement.classList.remove('dark');
                }
            "
            class="p-2.5 rounded-full shadow-lg backdrop-blur-md 
                bg-white/40 dark:bg-gray-800/40 
                hover:bg-white/60 dark:hover:bg-gray-700/60 
                transition-all duration-300 flex items-center justify-center
                
                sm:p-3    /* ukuran normal untuk tablet dan desktop */
                sm:right-5 sm:top-5
                
                max-sm:p-2    /* tombol lebih kecil untuk mobile */
                max-sm:right-3 max-sm:top-3
            "
            :title="darkMode ? 'Ganti ke Light Mode' : 'Ganti ke Dark Mode'"
        >
            <i x-show="darkMode" class="fas fa-sun text-yellow-300 text-lg sm:text-xl"></i>
            <i x-show="!darkMode" class="fas fa-moon text-gray-700 dark:text-gray-200 text-lg sm:text-xl"></i>
        </button>
    </div>

    @yield('content')

    @include('layouts.partials.script')
    @livewireScripts
</body>

</html>