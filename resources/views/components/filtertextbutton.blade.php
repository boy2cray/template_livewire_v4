<div class="bg-white/90 dark:bg-slate-900/70 backdrop-blur border border-gray-200/70 dark:border-slate-700 rounded-2xl shadow-sm p-5 md:p-6 mb-6 transition-all duration-300">

    <!-- Container -->
    <div class="flex flex-col lg:flex-row lg:items-end gap-4 lg:gap-6">

        <!-- Field search -->
        <div class="flex-1 space-y-2">

            <label for="search" class="flex items-center justify-between">
                <span class="text-[11px] font-semibold uppercase tracking-widest text-gray-500 dark:text-slate-400">
                    Cari...
                </span>

                <div wire:loading wire:target="search"
                    class="animate-spin h-3 w-3 border-2 border-blue-500 border-t-transparent rounded-full">
                </div>
            </label>

            <div class="relative group">

                <!-- Icon -->
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none
                            text-gray-400 group-focus-within:text-blue-500 transition-colors">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        >
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                </div>

                <!-- Input -->
                <input
                    id="search"
                    wire:model.live.debounce.500ms="search"
                    type="text"
                    placeholder="Cari..."
                    class="w-full h-12 rounded-xl border border-gray-200 dark:border-slate-600
                           bg-gray-50 dark:bg-slate-950
                           text-gray-900 dark:text-white text-sm
                           pl-10 pr-4
                           focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                           hover:border-gray-300 dark:hover:border-slate-500
                           transition-all duration-200"
                />

            </div>
        </div>

        <!-- Divider Responsive -->
        <div class="hidden lg:block h-10 w-px bg-gray-200 dark:bg-slate-700"></div>

        <!-- Button Action -->
        <div class="w-full sm:w-auto">

            <button
                wire:click="exportPDF"
                class="w-full sm:w-auto h-12 px-6 flex items-center justify-center gap-2
                       rounded-xl font-semibold text-sm
                       bg-linear-to-r from-red-500 to-rose-600
                       hover:from-red-600 hover:to-rose-700
                       text-white
                       shadow-sm hover:shadow-md
                       active:scale-[0.97]
                       transition-all duration-200">

                <svg class="w-5 h-5 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 17h6m-6-4h6m-6-8h3"/>
                </svg>

                <span>Cetak PDF</span>
            </button>

        </div>

    </div>
</div>
