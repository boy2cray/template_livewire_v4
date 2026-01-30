<div 
    x-show={{ $idModal }}
    x-transition.opacity.duration.300ms
    x-effect="document.body.classList.toggle('overflow-hidden', {{ $idModal }})"
    class="fixed inset-0 bg-black/40 backdrop-blur-sm flex items-center justify-center z-50 p-4"
    x-cloak
>
    <div 
        @click.away="$refs.submitButton.disabled ? '' : {{ $idModal }} = false"
        x-transition.scale.origin.center.duration.250ms
        class="relative {{ $ukuran }} bg-white rounded-2xl shadow-xl w-full flex flex-col max-h-[85vh] border border-gray-100
        dark:bg-gray-800 dark:border-gray-700 dark:shadow-gray-900/50"
    >
        <div class="flex items-center justify-between p-5 border-b border-gray-200 bg-linear-to-r from-white via-gray-50 to-gray-100 rounded-t-2xl
            dark:from-gray-800 dark:via-gray-800 dark:to-gray-900 dark:border-gray-700">
            <h3 class="text-lg font-semibold text-gray-800 flex items-center gap-2 dark:text-white">
                <x-icon name="delete" class="h-6 w-6 text-red-500" />
                {{ $labelModal }}
            </h3>

            <button 
                type="button" 
                @click="{{ $idModal }} = false" 
                wire:loading.attr="disabled"
                class="text-gray-400 hover:text-gray-600 hover:bg-gray-200 rounded-full p-2 transition
                dark:hover:bg-gray-700 dark:hover:text-gray-200"
            >
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
        </div>

        <div class="p-8 overflow-y-auto grow text-gray-700 dark:text-gray-300">
            <h3 class="text-lg font-semibold text-red-600 mb-2 dark:text-red-400">Hapus data berikut ini</h3>
            <p class="text-sm text-gray-600 mb-4 dark:text-gray-400">Data yang dihapus tidak dapat dikembalikan lagi</p>
            <hr class="my-2 border-gray-300 dark:border-gray-700">
            {{ $slot }}
        </div>

        <div class="flex items-center justify-end gap-3 p-4 border-t border-gray-200 bg-gray-50 rounded-b-2xl
            dark:bg-gray-900/50 dark:border-gray-700">
            <button 
                @click="{{ $idModal }} = false" 
                type="button"
                wire:loading.attr="disabled"
                wire:click="resetError"
                class="px-4 py-2.5 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-300 transition
                dark:bg-gray-800 dark:text-gray-200 dark:border-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
            >
                Batal
            </button>

            <button 
                type="button" 
                wire:click="{{ $clickEvent }}"
                wire:loading.attr="disabled"
                x-ref="submitButton"
                class="px-4 py-2.5 bg-red-500 hover:bg-red-600 text-white rounded-lg shadow-md hover:shadow-lg transition focus:outline-none focus:ring-2 focus:ring-red-300
                dark:bg-red-600 dark:hover:bg-red-700"
            >
                <span wire:loading wire:target="{{ $clickEvent }}" class="flex items-center gap-2">
                    <i class="fa-solid fa-spinner fa-spin"></i>
                    Proses...
                </span>

                <span wire:loading.remove wire:target="{{ $clickEvent }}">
                    {{ $buttonLabel }}
                </span>
            </button>
        </div>
    </div>
</div>