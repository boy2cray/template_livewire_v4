<div class="bg-white/90 dark:bg-slate-900/70 backdrop-blur border border-gray-200/70 dark:border-slate-700 rounded-2xl shadow-sm p-5 md:p-6 mb-6 transition-all duration-300">

    <div class="flex flex-col lg:flex-row lg:items-end gap-4 lg:gap-6">

        <!-- Bulan -->
        <div class="flex-1 space-y-2">
            <label for="bulan" class="flex items-center justify-between">
                <span class="text-[11px] font-semibold uppercase tracking-widest text-gray-500 dark:text-slate-400">
                    Pilih Bulan
                </span>

                <div wire:loading wire:target="bulan"
                    class="animate-spin h-3 w-3 border-2 border-blue-500 border-t-transparent rounded-full">
                </div>
            </label>

            <div class="relative group">

                <select
                    id="bulan"
                    wire:model.live="bulan"
                    class="w-full h-12 rounded-xl border border-gray-200 dark:border-slate-600
                           bg-gray-50 dark:bg-slate-950
                           text-gray-900 dark:text-white text-sm
                           px-4 pr-10
                           focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                           hover:border-gray-300 dark:hover:border-slate-500
                           transition-all duration-200
                           appearance-none cursor-pointer">

                    <option value="">-- Semua Bulan --</option>

                    @foreach (range(1, 12) as $m)
                        <option value="{{ $m }}">
                            {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}
                        </option>
                    @endforeach

                </select>

                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none
                            text-gray-400 group-focus-within:text-blue-500 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 9l-7 7-7-7"/>
                    </svg>
                </div>

            </div>
        </div>

        <!-- Tahun -->
        <div class="flex-1 space-y-2">

            <label for="tahun" class="flex items-center justify-between">
                <span class="text-[11px] font-semibold uppercase tracking-widest text-gray-500 dark:text-slate-400">
                    Tahun Laporan
                </span>

                <div wire:loading wire:target="tahun"
                    class="animate-spin h-3 w-3 border-2 border-blue-500 border-t-transparent rounded-full">
                </div>
            </label>

            <div class="relative group">

                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none
                            text-gray-400 group-focus-within:text-blue-500 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>

                <input
                    id="tahun"
                    wire:model.live.debounce.500ms="tahun"
                    type="number"
                    placeholder="Contoh : 2026"
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

        <!-- Divider Desktop -->
        <div class="hidden lg:block h-10 w-px bg-gray-200 dark:bg-slate-700"></div>

        <!-- Button -->
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
