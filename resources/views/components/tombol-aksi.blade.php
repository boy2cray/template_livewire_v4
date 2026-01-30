@props([
    'showDetail' => false,
    'showEdit' => false,
    'showDelete' => false,
    'showPrint' => false,
    'idx' => '',
])

@if ($showPrint)
    <button 
        wire:click="tampilCetak({{ $idx }})"
        wire:loading.attr="disabled"
        class="relative flex items-center justify-center w-9 h-9 rounded-full 
            bg-yellow-50 text-yellow-600 hover:bg-yellow-500 hover:text-white
            dark:bg-yellow-900/30 dark:text-yellow-400 dark:hover:bg-yellow-600 dark:hover:text-white
            shadow-sm hover:shadow-md transition-all duration-300 disabled:opacity-60"
        title="Cetak PDF"
    >
        <i class="fa-solid fa-print" wire:loading.remove wire:target="tampilCetak({{ $idx }})"></i>
        <svg wire:loading wire:target="tampilCetak({{ $idx }})"
             class="w-4 h-4 animate-spin text-yellow-600 dark:text-yellow-400"
             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor"
                d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
        </svg>
    </button>
@endif

@if ($showDetail)
    <button 
        wire:click="tampilDetail({{ $idx }})"
        wire:loading.attr="disabled"
        class="relative flex items-center justify-center w-9 h-9 rounded-full 
            bg-green-100 hover:bg-green-500 text-green-600 hover:text-white 
            dark:bg-green-900/30 dark:text-green-400 dark:hover:bg-green-600 dark:hover:text-white
            shadow-sm hover:shadow-md transition-all duration-300 disabled:opacity-60"
        title="Lihat Detail"
    >
        <i class="fa-solid fa-eye" wire:loading.remove wire:target="tampilDetail({{ $idx }})"></i>
        <svg wire:loading wire:target="tampilDetail({{ $idx }})"
             class="w-4 h-4 animate-spin text-green-600 dark:text-green-400"
             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor"
                d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
        </svg>
    </button>
@endif

@if ($showEdit)
    <button 
        wire:click="tampilEdit({{ $idx }})"
        wire:loading.attr="disabled"
        class="relative flex items-center justify-center w-9 h-9 rounded-full 
            bg-blue-100 hover:bg-blue-500 text-blue-600 hover:text-white 
            dark:bg-blue-900/30 dark:text-blue-400 dark:hover:bg-blue-600 dark:hover:text-white
            shadow-sm hover:shadow-md transition-all duration-300 disabled:opacity-60"
        title="Edit"
    >
        <i class="fa-solid fa-pen-to-square" wire:loading.remove wire:target="tampilEdit({{ $idx }})"></i>
        <svg wire:loading wire:target="tampilEdit({{ $idx }})"
             class="w-4 h-4 animate-spin text-blue-600 dark:text-blue-400"
             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor"
                d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
        </svg>
    </button>
@endif

@if ($showDelete)
    <button 
        wire:click="tampilHapus({{ $idx }})"
        wire:loading.attr="disabled"
        class="relative flex items-center justify-center w-9 h-9 rounded-full 
            bg-red-100 hover:bg-red-500 text-red-600 hover:text-white 
            dark:bg-red-900/30 dark:text-red-400 dark:hover:bg-red-600 dark:hover:text-white
            shadow-sm hover:shadow-md transition-all duration-300 disabled:opacity-60"
        title="Hapus"
    >
        <i class="fa-solid fa-trash" wire:loading.remove wire:target="tampilHapus({{ $idx }})"></i>
        <svg wire:loading wire:target="tampilHapus({{ $idx }})"
             class="w-4 h-4 animate-spin text-red-600 dark:text-red-400"
             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor"
                d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
        </svg>
    </button>
@endif