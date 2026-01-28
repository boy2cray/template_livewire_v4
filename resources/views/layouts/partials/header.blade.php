<header class="h-17 bg-linear-to-r from-blue-500 via-blue-600 to-blue-700 shadow-md p-4 flex justify-between items-center transition-colors duration-300
    dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 dark:border-b dark:border-gray-700">
    
    <div class="flex items-center">
        <button @click="sidebarOpen = !sidebarOpen" class="text-white focus:outline-none md:hidden">
            <i x-show="!sidebarOpen" class="fas fa-bars fa-lg"></i>
            <i x-show="sidebarOpen" class="fas fa-times fa-lg" style="display: none;"></i>
        </button>

        <button @click="isSidebarPinned = !isSidebarPinned" class="text-white focus:outline-none hidden md:block">
            <i class="fas fa-bars fa-lg"></i>
        </button>

        <h1 class="ml-4 text-xl font-semibold text-white">@yield('title', 'Dashboard')</h1>
    </div>

    <div class="flex items-center gap-3 sm:gap-4">
        
        <button 
            x-data="{ 
                darkMode: localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches) 
            }" 
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
            class="p-2 rounded-full text-white/80 hover:bg-white/10 transition-colors focus:outline-none"
            :title="darkMode ? 'Ganti ke Light Mode' : 'Ganti ke Dark Mode'"
        >
            <i x-show="darkMode" class="fas fa-sun text-yellow-300 text-lg"></i>
            <i x-show="!darkMode" class="fas fa-moon text-white text-lg"></i>
        </button>

        <div x-data="{ dropdownOpen: false }" class="relative">
            <button @click="dropdownOpen = !dropdownOpen" class="relative block h-10 w-10 rounded-full overflow-hidden border-2 border-gray-300 focus:outline-none focus:border-blue-500 dark:border-gray-600">
                <img class="h-full w-full object-cover rounded-full ring-2 ring-blue-400 transition duration-300 hover:ring-4 hover:ring-blue-600 dark:ring-gray-500" 
                src="{{ session('foto')?asset('storage/' . session('foto')):asset('images/d_avatar.png') }}"
                alt="Foto Profil">
            </button>

            <div x-show="dropdownOpen" 
                @click.away="dropdownOpen = false"
                x-transition:enter="transition ease-out duration-150"
                x-transition:enter-start="transform opacity-0 scale-90"
                x-transition:enter-end="transform opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-100"
                x-transition:leave-start="transform opacity-100 scale-100"
                x-transition:leave-end="transform opacity-0 scale-90"
                class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-2xl z-60 border border-blue-100 
                dark:bg-gray-800 dark:border-gray-700 dark:text-gray-200"
                style="display: none;">

                <div class="flex items-center px-4 py-3 border-b border-gray-100 dark:border-gray-700">
                    <img class="h-10 w-10 rounded-full object-cover mr-3 ring-2 ring-blue-400 dark:ring-gray-500" 
                        src="{{ session('foto')?asset('storage/' . session('foto')):asset('images/d_avatar.png') }}" 
                        alt="Foto Profil"
                    >
                    <div>
                        <p class="text-sm font-semibold text-gray-800 dark:text-white">{{ session('nama')??'Not Found' }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ session('email')??'Not Found' }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Sebagai : {{ session('otoritas')??'Not Found' }}</p>
                    </div>
                </div>
                
                <a href="/profil" wire:navigate class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-blue-500 hover:text-white hover:rounded-md transition
                   dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white">
                    <i class="fas fa-user"></i> Profil
                </a>
                
                <div class="border-t border-gray-100 dark:border-gray-700"></div>

                {{-- Pastikan komponen logout-button juga disesuaikan jika punya style sendiri --}}
                <div class="hover:bg-red-50 dark:hover:bg-red-900/20 hover:rounded-b-xl transition">
                    {{-- @livewire('logout-button') --}}
                </div>

            </div>
        </div>
    </div>
</header>