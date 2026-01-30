<div class="relative mb-4 w-full">

    {{-- Input teks pencarian --}}
    <div class="flex flex-row items-center 
        border border-gray-200 rounded-xl shadow-sm bg-white 
        focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500 
        transition-all duration-150

        dark:bg-gray-900 dark:border-gray-700 dark:shadow-none 
        dark:focus-within:ring-indigo-500 dark:focus-within:ring-offset-gray-800
    ">
        
        {{-- Icon search --}}
        <span class="pl-3 pr-2 text-gray-400 dark:text-gray-300">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" 
                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" 
                class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" 
                    d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>
        </span>

        <input 
            type="text" 
            wire:model.live="search" 
            placeholder="{{ $placeholder }}" 
            class="w-full h-full py-2.5 
                text-gray-700 bg-transparent border-none rounded-xl 
                focus:outline-none focus:ring-0 
                
                dark:text-gray-200 dark:placeholder-gray-400
            "
        >

        @if($search)
            <button 
                wire:click="clearSelection" 
                type="button" 
                class="px-3 text-gray-400 hover:text-red-600 
                    dark:text-gray-300 dark:hover:text-red-400
                    transition duration-150 ease-in-out"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" 
                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" 
                    class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" 
                        d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        @endif
    </div>

    {{-- Hidden input untuk parent --}}
    <input type="hidden" wire:model="selectedId">

    {{-- Daftar suggestion --}}
    @if (!empty($results))
        <ul class="absolute z-50 w-full mt-1 
            bg-white border border-gray-200 rounded-xl shadow-lg 
            max-h-60 overflow-auto divide-y divide-gray-100

            dark:bg-gray-900 dark:border-gray-700 
            dark:divide-gray-800 dark:shadow-none
        ">
            @forelse ($results as $item)
                <li 
                    wire:click="selectItem('{{ $item->$valueField }}', '{{ $item->$searchField }}')" 
                    class="px-4 py-3 cursor-pointer 
                        hover:bg-gray-100 dark:hover:bg-gray-800 
                        transition duration-150 ease-in-out
                    "
                >
                    <p class="text-gray-800 font-medium dark:text-gray-200">
                        {{ $item->$searchField }}
                    </p>

                    <p class="text-xs text-gray-500 dark:text-gray-400">
                        ID: {{ $item->$valueField }}
                    </p>

                    <p class="text-xs text-blue-500 dark:text-blue-400">
                        {{ $kodeField }}: {{ $item->$kodeField }}
                    </p>
                </li>
            @empty
                <li class="px-4 py-3 text-center 
                    text-gray-500 italic 
                    dark:text-gray-400
                ">
                    Tidak ada hasil yang ditemukan
                </li>
            @endforelse
        </ul>
    @endif

    {{-- Pesan Error --}}
    @if(!empty($errorKey))
        @error($errorKey)
            <p class="mt-1 text-sm text-red-600 font-medium animate-pulse dark:text-red-400">
                {{ $message }}
            </p>
        @enderror
    @endif

</div>