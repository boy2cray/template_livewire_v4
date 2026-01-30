<div 
    x-show={{ $idModal }}
    x-transition.opacity.duration.300ms
    x-effect="document.body.classList.toggle('overflow-hidden', {{ $idModal }})"
    class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm flex items-center justify-center z-90 p-4"
    x-cloak
>
    <div 
        x-transition.scale.origin.center.duration.300ms
        class="relative {{ $ukuran }} bg-white rounded-2xl shadow-2xl w-full flex flex-col max-h-[95vh] border border-gray-200 
        dark:bg-gray-800 dark:border-gray-700 dark:shadow-gray-900/50"
    >
        <div class="flex items-center justify-between p-5 border-b border-gray-200 bg-linear-to-br from-white via-blue-100 to-blue-200 backdrop-blur-md rounded-t-2xl
            dark:from-gray-800 dark:via-gray-800 dark:to-gray-900 dark:border-gray-700">
            {{-- Judul Modal --}}
            <h3 class="text-xl font-semibold text-gray-800 flex items-center gap-2 dark:text-white">
                <x-icon
                    name='{{ $icon }}'
                    class='h-8 w-8 dark:text-blue-400'
                />
                {{ $labelModal }}
            </h3>

            {{-- Tombol x / tutup modal --}}
            <button 
                type="button" 
                @click="{{ $idModal }} = false"
                wire:click="resetImport"
                wire:loading.attr="disabled"
                class="text-gray-400 hover:text-gray-700 hover:bg-gray-200 rounded-full p-2 transition
                dark:text-gray-400 dark:hover:text-gray-200 dark:hover:bg-gray-700"
            >
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
        </div>

        <div class="p-1 overflow-y-auto grow dark:text-gray-300">
            {{ $slot}}
        </div>

    </div>
</div>