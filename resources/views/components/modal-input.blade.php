<div 
    x-show={{ $idModal }}
    x-transition.opacity.duration.300ms
    x-effect="document.body.classList.toggle('overflow-hidden', {{ $idModal }})"
    class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm flex items-center justify-center z-90 p-4"
    x-cloak
>
    <div 
        x-transition.scale.origin.center.duration.300ms
        class="relative {{ $ukuran }} bg-white rounded-2xl shadow-2xl w-full flex flex-col max-h-[85vh] border border-gray-200
        dark:bg-gray-800 dark:border-gray-700 dark:shadow-gray-900/50"
    >
        <div class="flex items-center justify-between p-5 border-b border-gray-200 bg-linear-to-br from-white via-blue-100 to-blue-200 backdrop-blur-md rounded-t-2xl
            dark:from-gray-800 dark:via-gray-800 dark:to-gray-900 dark:border-gray-700">
            {{-- Judul Modal --}}
            <h3 class="text-xl font-semibold text-gray-800 flex items-center gap-2 dark:text-white">
                <x-icon
                    name='{{ $icon }}'
                    class='h-8 w-8 text-blue-600 dark:text-blue-400'
                />
                {{ $labelModal }}
            </h3>

            {{-- Tombol x / tutup modal --}}
            <button 
                type="button" 
                @click="{{ $idModal }} = false" 
                wire:loading.attr="disabled"
                class="text-gray-400 hover:text-gray-700 hover:bg-gray-200 rounded-full p-2 transition
                dark:hover:bg-gray-700 dark:hover:text-gray-200"
            >
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
        </div>

        <div class="p-12 overflow-y-auto grow dark:text-gray-300">
            {{ $slot}}
        </div>

        <div class="flex items-center justify-end gap-3 p-5 border-t border-gray-200 bg-linear-to-br from-white via-blue-100 to-blue-200 backdrop-blur-md rounded-b-2xl
            dark:from-gray-800 dark:via-gray-800 dark:to-gray-900 dark:border-gray-700">
            {{-- Tombol Batal --}}
            <button 
                @click="{{ $idModal }} = false" 
                type="button"
                wire:loading.attr="disabled"
                wire:click="resetError"
                class="px-4 py-2.5 text-gray-700 bg-white rounded-lg hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300 transition
                dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600 dark:focus:ring-gray-600"
            >
                Batal
            </button>

            {{-- Tombol proses / simpan --}}
            <button 
                type="button" 
                wire:click="{{ $clickEvent }}"
                wire:loading.attr="disabled"
                x-ref="submitButton"
              
                class="px-4 py-2.5 bg-linear-to-r from-blue-500 to-blue-600 text-white rounded-lg hover:from-blue-600 hover:to-blue-700 shadow-md hover:shadow-lg transition focus:outline-none focus:ring-2 focus:ring-blue-300"
            >
                {{-- Tampilan saat loading --}}
                <span wire:loading wire:target="{{ $clickEvent }}" class="flex items-center gap-2">
                    <i class="fa-solid fa-spinner fa-spin"></i>
                    proses
                </span>
                {{-- Tampilan normal --}}
                <span wire:loading.remove wire:target="{{ $clickEvent }}">
                    {{ $buttonLabel }}
                </span>
            </button>
        </div>
    </div>
</div>