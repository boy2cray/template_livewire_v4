@if ($paginator->hasPages())
<nav 
    role="navigation" 
    aria-label="Pagination Navigation" 
    class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-3 sm:space-y-0"
    wire:key="pagination-{{ $paginator->currentPage() }}"
>

    <div class="flex items-center justify-center space-x-1">

        {{-- Tombol Sebelumnya --}}
        @if ($paginator->onFirstPage())
            <span class="px-3 py-2 rounded-lg 
                text-gray-400 bg-gray-100 border border-gray-200 shadow-sm cursor-not-allowed
                dark:text-gray-600 dark:bg-gray-800 dark:border-gray-700
            ">
                <i class="fa-solid fa-angle-left"></i>
                <span class="hidden sm:inline ml-1">Sebelumnya</span>
            </span>
        @else
            <button 
                wire:click="previousPage"
                wire:loading.attr="disabled"
                wire:target="previousPage"
                class="relative px-3 py-2 rounded-lg 
                    bg-blue-100 text-blue-600 border border-blue-200 shadow-sm 
                    hover:bg-blue-500 hover:text-white transition
                    dark:bg-blue-900 dark:text-blue-300 dark:border-blue-700 
                    dark:hover:bg-blue-600 dark:hover:text-white
                "
            >
                <span wire:loading.remove wire:target="previousPage">
                    <i class="fa-solid fa-angle-left"></i>
                    <span class="hidden sm:inline ml-1">Sebelumnya</span>
                </span>

                <span wire:loading.flex wire:target="previousPage" class="absolute inset-0 flex items-center justify-center">
                    <svg class="animate-spin h-4 w-4 text-blue-600 dark:text-blue-300" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke-width="4" stroke="currentColor"/>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"/>
                    </svg>
                </span>
            </button>
        @endif


        {{-- Nomor Halaman --}}
        <div class="hidden sm:flex space-x-1">
            @foreach ($elements as $element)

                @if (is_string($element))
                    <span class="px-3 py-2 text-gray-500 dark:text-gray-400">{{ $element }}</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)

                        @if ($page == $paginator->currentPage())
                            <span class="px-3 py-2 rounded-lg 
                                bg-blue-500 text-white font-semibold shadow-md
                                dark:bg-blue-600
                            ">
                                {{ $page }}
                            </span>
                        @else
                            <button 
                                wire:click="gotoPage({{ $page }})"
                                wire:loading.attr="disabled"
                                wire:key="page-{{ $page }}"
                                class="relative px-3 py-2 rounded-lg 
                                    bg-white text-blue-600 border border-blue-200 shadow-sm 
                                    hover:bg-blue-500 hover:text-white transition
                                    dark:bg-gray-900 dark:text-blue-300 dark:border-gray-700 
                                    dark:hover:bg-blue-600 dark:hover:text-white
                                "
                            >
                                <span wire:loading.remove wire:target="gotoPage({{ $page }})">
                                    {{ $page }}
                                </span>

                                <span wire:loading.flex wire:target="gotoPage({{ $page }})" class="absolute inset-0 flex items-center justify-center">
                                    <svg class="animate-spin h-4 w-4 text-blue-600 dark:text-blue-300" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke-width="4" stroke="currentColor"/>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"/>
                                    </svg>
                                </span>
                            </button>
                        @endif

                    @endforeach
                @endif

            @endforeach
        </div>


        {{-- Tombol Berikutnya --}}
        @if ($paginator->hasMorePages())
            <button 
                wire:click="nextPage"
                wire:loading.attr="disabled"
                wire:target="nextPage"
                class="relative px-3 py-2 rounded-lg 
                    bg-blue-100 text-blue-600 border border-blue-200 shadow-sm 
                    hover:bg-blue-500 hover:text-white transition
                    dark:bg-blue-900 dark:text-blue-300 dark:border-blue-700 
                    dark:hover:bg-blue-600 dark:hover:text-white
                "
            >
                <span wire:loading.remove wire:target="nextPage">
                    <span class="hidden sm:inline mr-1">Berikutnya</span>
                    <i class="fa-solid fa-angle-right"></i>
                </span>

                <span wire:loading.flex wire:target="nextPage" class="absolute inset-0 flex items-center justify-center">
                    <svg class="animate-spin h-4 w-4 text-blue-600 dark:text-blue-300" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke-width="4" stroke="currentColor"/>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"/>
                    </svg>
                </span>
            </button>
        @else
            <span class="px-3 py-2 rounded-lg 
                text-gray-400 bg-gray-100 border border-gray-200 shadow-sm cursor-not-allowed
                dark:text-gray-600 dark:bg-gray-800 dark:border-gray-700
            ">
                <span class="hidden sm:inline mr-1">Berikutnya</span>
                <i class="fa-solid fa-angle-right"></i>
            </span>
        @endif

    </div>

</nav>
@endif