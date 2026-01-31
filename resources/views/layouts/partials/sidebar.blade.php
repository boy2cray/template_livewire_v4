<div 
    x-show="sidebarOpen" 
    @click="sidebarOpen = false"
    class="fixed inset-0 bg-black/50 z-40 md:hidden backdrop-blur-sm"
    x-transition:enter="transition-opacity ease-linear duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition-opacity ease-linear duration-300"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    x-cloak 
></div>

@php
    $otoritas = session('otoritas');
    // Mengambil data dari config/sidebar.php
    $sidebarMenus = config('sidebar.menus');
@endphp

<aside
    @mouseenter="if (window.innerWidth >= 768) { isSidebarHovered = true }"
    @mouseleave="if (window.innerWidth >= 768) { isSidebarHovered = false }"
    class="fixed inset-y-0 left-0 z-50 flex flex-col shrink-0 text-slate-300 transition-all duration-300 ease-in-out transform -translate-x-full md:translate-x-0
    bg-linear-to-br from-slate-900 via-sky-800 to-sky-600 
    dark:from-gray-950 dark:via-gray-900 dark:to-gray-900 dark:text-gray-400 dark:border-r dark:border-gray-800"
    :class="{
        'w-64': isSidebarPinned || isSidebarHovered, 
        'w-20': !isSidebarPinned && !isSidebarHovered,
        'translate-x-0': sidebarOpen
    }"
>
    <div class="h-16 flex items-center px-4 shrink-0" 
         :class="(isSidebarPinned || isSidebarHovered) ? 'justify-start' : 'justify-center'">
        <a href="#" class="flex items-center text-white">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10 w-10 shrink-0">
            <div class="ml-3 transition-all duration-200 overflow-hidden"
                 :class="{'opacity-0 w-0': !(isSidebarPinned || isSidebarHovered), 'opacity-100 w-auto': isSidebarPinned || isSidebarHovered}">
                <span class="text-lg font-bold whitespace-nowrap block">
                    ARTEK
                </span>
                <span class="text-xs text-slate-400 whitespace-nowrap block">
                    By:Eko-Teknik
                </span>
            </div>
        </a>
    </div>

    <div class="px-3 py-2" x-show="isSidebarPinned || isSidebarHovered" x-cloak>
        <input 
            x-model.debounce.300ms="searchTerm" 
            type="text" 
            placeholder="Cari menu..."
            class="w-full px-3 py-2 text-sm bg-slate-800 text-slate-300 rounded-lg border border-slate-700 focus:outline-none focus:ring-1 focus:ring-sky-500 transition
            dark:bg-gray-950 dark:border-gray-700 dark:text-gray-300 dark:focus:ring-gray-500">
    </div>

    {{-- LOOPING MENU DI config/sidebar.php --}}
    <nav class="flex-1 overflow-y-auto py-4 space-y-2 custom-scrollbar">
        @foreach ($sidebarMenus as $menu)
            {{-- Cek Otoritas --}}
            @if (in_array($otoritas, $menu['roles']))
                
                @php
                    // Logika Active untuk Menu Utama
                    $isActive = isset($menu['route']) 
                                ? request()->is($menu['route']) 
                                : (isset($menu['submenu']) && collect($menu['submenu'])->pluck('route')->contains(fn($val) => request()->is($val)));
                @endphp

                {{-- MENU TANPA SUBMENU --}}
                @if (!isset($menu['submenu']))
                    <a href="/{{ $menu['route'] }}" wire:navigate
                       x-show="searchTerm === '' || '{{ $menu['title'] }}'.toLowerCase().includes(searchTerm.toLowerCase())"
                       @class([
                           'group flex items-center py-2.5 mx-2 rounded-lg transition-colors duration-200',
                           'bg-sky-500/10 text-sky-400 border-l-4 border-sky-500 pl-3' => $isActive,
                           'hover:bg-slate-800 hover:text-white pl-4' => !$isActive
                       ])
                       :class="(isSidebarPinned || isSidebarHovered) ? 'justify-start' : 'justify-center'">
                        <i class="{{ $menu['icon'] }} w-8 text-center text-lg shrink-0"></i>
                        <span class="ml-4 whitespace-nowrap" :class="{'hidden': !(isSidebarPinned || isSidebarHovered)}">
                            {{ $menu['title'] }}
                        </span>
                    </a>

                {{-- MENU DENGAN SUBMENU --}}
                @else
                    <div x-data="{ isOpen: {{ $isActive ? 'true' : 'false' }} }"
                         x-show="searchTerm === '' || '{{ $menu['title'] }}'.toLowerCase().includes(searchTerm.toLowerCase())"
                         class="relative mx-2">
                        
                        <button @click="if (isSidebarPinned || isSidebarHovered) isOpen = !isOpen"
                                @class([
                                    'group w-full flex items-center text-left py-2.5 rounded-lg transition-colors duration-200',
                                    'bg-sky-500/10 text-sky-400 border-l-4 border-sky-500 pl-3' => $isActive,
                                    'hover:bg-slate-800 hover:text-white pl-4' => !$isActive
                                ])
                                :class="(isSidebarPinned || isSidebarHovered) ? 'justify-between' : 'justify-center'">
                            <div class="flex items-center">
                                <i class="{{ $menu['icon'] }} w-8 text-center text-lg shrink-0"></i>
                                <span class="ml-4 whitespace-nowrap" :class="{'hidden': !(isSidebarPinned || isSidebarHovered)}">
                                    {{ $menu['title'] }}
                                </span>
                            </div>
                            <i x-show="(isSidebarPinned || isSidebarHovered)" 
                               class="fas fa-chevron-down transform transition-transform duration-200 mr-4" 
                               :class="{'rotate-180': isOpen}" x-cloak></i>
                        </button>

                        <div x-show="isOpen" x-transition class="text-sm text-slate-400"
                             :class="{
                                 'absolute left-full top-0 w-48 ml-2 p-2 bg-slate-800 rounded-md shadow-lg': !(isSidebarPinned || isSidebarHovered),
                                 'mt-2 space-y-1 bg-black/20 rounded-md p-2': (isSidebarPinned || isSidebarHovered)
                             }" x-cloak>
                            
                            @foreach ($menu['submenu'] as $sub)
                                @if(isset($sub['child']))
                                    {{-- LOGIKA LEVEL 3 --}}
                                    @php $isChildActive = collect($sub['child'])->pluck('route')->contains(fn($r) => request()->is($r)); @endphp
                                    <div x-data="{ isChildOpen: {{ $isChildActive ? 'true' : 'false' }} }">
                                        <button @click="isChildOpen = !isChildOpen" class="w-full flex items-center justify-between py-2 px-4 rounded-md hover:bg-slate-700">
                                            <span>{{ $sub['title'] }}</span>
                                            <i class="fas fa-chevron-down text-xs" :class="{'rotate-180': isChildOpen}"></i>
                                        </button>
                                        <div x-show="isChildOpen" class="pl-4 mt-1 space-y-1">
                                            @foreach($sub['child'] as $child)
                                                <a href="/{{ $child['route'] }}" wire:navigate @class(['block py-2 px-4 rounded-md hover:bg-slate-600', 'text-sky-400 bg-slate-700' => request()->is($child['route'])])>
                                                    {{ $child['title'] }}
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                @else
                                    <a href="/{{ $sub['route'] }}" wire:navigate @class(['block py-2 px-4 rounded-md hover:bg-slate-700', 'text-sky-400 bg-slate-700' => request()->is($sub['route'])])>
                                        {{ $sub['title'] }}
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif
            @endif
        @endforeach
    </nav>
</aside>