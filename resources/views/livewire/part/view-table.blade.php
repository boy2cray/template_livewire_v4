<div>
    {{-- Input Filter Data --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-4">
        <div class="relative w-full sm:w-1/2">
            @if ($search_type == 'date')
                {{-- Input rentang tanggal --}}
                <div class="flex flex-col sm:flex-row gap-2 w-full">
                    <div class="relative w-full sm:w-1/3">
                        <input type="date" wire:model.live="tgl_awal"
                            class="w-full border border-gray-200 rounded-lg py-2.5 px-4 pl-10 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent bg-white shadow-sm hover:shadow-md transition-all 
                            dark:bg-gray-800 dark:border-gray-700 dark:text-gray-200 dark:focus:ring-blue-500 scheme-light dark:scheme-dark"
                            placeholder="Dari">
                        <i class="fa-solid fa-calendar-days absolute left-3 top-3.5 text-gray-400 dark:text-gray-500"></i>
                    </div>

                    <div class="relative w-full sm:w-1/3">
                        <input type="date" wire:model.live="tgl_akhir"
                            class="w-full border border-gray-200 rounded-lg py-2.5 px-4 pl-10 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent bg-white shadow-sm hover:shadow-md transition-all 
                            dark:bg-gray-800 dark:border-gray-700 dark:text-gray-200 dark:focus:ring-blue-500 scheme-light dark:scheme-dark"
                            placeholder="Sampai">
                        <i class="fa-solid fa-calendar-days absolute left-3 top-3.5 text-gray-400 dark:text-gray-500"></i>
                    </div>

                    <button wire:click="resetDate"
                        class="w-full sm:w-auto px-4 py-2.5 bg-gray-300 hover:bg-gray-200 text-gray-600 rounded-lg transition-colors duration-200 flex items-center justify-center gap-2 
                        dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-gray-200">
                        <i class="fa-solid fa-rotate-left"></i>
                        Reset
                    </button>
                    <button wire:click="eksportExcel" wire:loading.attr="disabled" wire:target="eksportExcel"
                        class="w-full sm:w-auto px-4 py-2.5 bg-green-600 hover:bg-green-500 text-white rounded-lg transition-colors duration-200 flex items-center justify-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed">
                        <i class="fa-solid fa-file-excel" wire:loading.remove wire:target="eksportExcel"></i>
                        <i class="fa-solid fa-spinner fa-spin" wire:loading wire:target="eksportExcel"></i>
                        Excel
                    </button>
                </div>
            @else
                {{-- Input teks pencarian --}}
                <div class="relative w-full">
                    <input type="text" wire:model.live.debounce.400ms="search" placeholder="Cari ..."
                        class="w-full border border-gray-200 rounded-lg py-2.5 px-4 pl-10 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent bg-white shadow-sm hover:shadow-md transition-all 
                        dark:bg-gray-800 dark:border-gray-700 dark:text-gray-200 dark:placeholder-gray-500">
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-3.5 text-gray-400 dark:text-gray-500"></i>
                </div>
            @endif
        </div>

        {{-- select rentang halaman --}}
        <div class="w-full sm:w-auto flex justify-between sm:justify-end items-center">
            <label for="perPage" class="text-sm text-gray-600 mr-2 hidden sm:inline-block dark:text-gray-400">Tampilkan</label>
            <div class="relative w-full sm:w-40">
                <select wire:model.live="perPage"
                    class="appearance-none w-full border border-gray-200 rounded-lg py-2.5 px-4 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent bg-white shadow-sm hover:shadow-md transition-all pr-10 
                    dark:bg-gray-800 dark:border-gray-700 dark:text-gray-200">
                    <option value="10">10 / halaman</option>
                    <option value="25">25 / halaman</option>
                    <option value="50">50 / halaman</option>
                    <option value="100">100 / halaman</option>
                </select>
                <i class="fa-solid fa-chevron-down absolute right-3 top-3.5 text-gray-400 pointer-events-none dark:text-gray-500"></i>
            </div>
        </div>
    </div>

    {{-- TABEL --}}
    <div class="relative" wire:loading.class="opacity-50 pointer-events-none">
        {{-- Loader Tabel --}}
        <div wire:loading.flex class="absolute inset-0 items-center justify-center z-10 hidden">
            <div class="bg-white p-2 rounded-full shadow-lg dark:bg-gray-800 dark:shadow-gray-900/50">
                <i class="fa-solid fa-circle-notch fa-spin text-blue-600 text-2xl dark:text-blue-400"></i>
            </div>
        </div>

        {{-- Tabel Desktop --}}
        <div class="hidden md:block overflow-x-auto border border-gray-200 rounded-xl shadow-sm bg-white dark:bg-gray-800 dark:border-gray-700">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                {{-- Header: Menggunakan gradient gelap saat darkmode --}}
                <thead class="bg-linear-to-r from-blue-100 to-blue-50 dark:from-gray-700 dark:to-gray-800">
                    <tr>
                        @foreach ($headers as $header)
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider dark:text-gray-300">
                                @if ($header['key'])
                                    <a href="#" wire:click.prevent="urutkan('{{ $header['skey'] }}')"
                                        class="hover:text-blue-600 dark:hover:text-blue-400 group flex items-center gap-1">
                                        {{ $header['label'] }}
                                        @if ($sortBy === $header['skey'])
                                            <span class="text-blue-600 dark:text-blue-400">{{ $sortDir === 'asc' ? '↑' : '↓' }}</span>
                                        @else
                                            <span class="text-gray-300 opacity-0 group-hover:opacity-100 transition-opacity text-[10px] dark:text-gray-500">↕</span>
                                        @endif
                                    </a>
                                @else
                                    {{ $header['label'] }}
                                @endif
                            </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100 dark:bg-gray-800 dark:divide-gray-700">
                    @forelse ($konten as $item)
                        <tr wire:key="row-{{ $item->id }}" class="hover:bg-blue-50/50 transition-colors duration-200 dark:hover:bg-gray-700/50">
                            @foreach ($headers as $header)
                                @if ($header['label'] === '#')
                                    <td class="px-4 py-3 text-sm text-gray-800 w-16 dark:text-gray-300">
                                        @if ($konten instanceof \Illuminate\Pagination\LengthAwarePaginator)
                                            {{ ($konten->currentPage() - 1) * $konten->perPage() + $loop->parent->iteration }}
                                        @else
                                            {{ $loop->parent->iteration }}
                                        @endif
                                    </td>
                                @elseif ($header['label'] === 'Aksi')
                                    <td class="px-4 py-3 text-sm">
                                        <div class="flex items-center gap-2">
                                            {{-- Pastikan komponen x-tombol-aksi juga support dark mode (biasanya otomatis jika pakai class tailwind standar) --}}
                                            <x-tombol-aksi 
                                                :showPrint="$btnPrint" 
                                                :showDetail="$btnShow" 
                                                :showEdit="$btnEdit"
                                                :showDelete="$btnDelete" 
                                                idx="{{ $item->id }}" 
                                            />
                                        </div>
                                    </td>
                                @elseif ($header['label'] === 'Foto')
                                    <td class="px-4 py-2 w-20">
                                        @if ($item->file)
                                            <img src="{{ asset('storage/' . $item->file) }}" alt="Foto"
                                                class="h-10 w-10 rounded-full object-cover border border-gray-200 dark:border-gray-600">
                                        @else
                                            <div class="h-10 w-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-400 dark:bg-gray-700 dark:text-gray-500">
                                                <i class="fa-solid fa-user"></i>
                                            </div>
                                        @endif
                                    </td>
                                @else
                                    <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-300">
                                        {{ data_get($item, $header['key'], '-') }}
                                    </td>
                                @endif
                            @endforeach
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ count($headers) }}" class="px-4 py-12 text-center text-gray-500 text-sm dark:text-gray-400">
                                <div class="flex flex-col items-center justify-center gap-2">
                                    <i class="fa-regular fa-folder-open text-2xl text-gray-300 dark:text-gray-600"></i>
                                    <p>Tidak ada data yang ditemukan.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Tabel Mobile / Card --}}
        <div class="md:hidden space-y-4">
            @forelse ($konten as $item)
                <div wire:key="card-{{ $item->id }}"
                    class="rounded-2xl border border-gray-100 bg-linear-to-br from-white to-blue-50 p-4 shadow-sm hover:shadow-lg transition-all duration-300 
                    dark:from-gray-800 dark:to-gray-900 dark:border-gray-700 dark:shadow-gray-900/30">

                    @foreach ($headers as $header)
                        @if ($header['label'] === '#')
                            <div class="flex justify-between items-start mb-3">
                                <div class="flex items-center justify-center w-8 h-8 bg-blue-100 text-blue-700 rounded-full font-medium text-xs shadow-sm dark:bg-blue-900 dark:text-blue-300">
                                    @if ($konten instanceof \Illuminate\Pagination\LengthAwarePaginator)
                                        #{{ ($konten->currentPage() - 1) * $konten->perPage() + $loop->parent->iteration }}
                                    @else
                                        #{{ $loop->parent->iteration }}
                                    @endif
                                </div>
                            </div>
                        @elseif ($header['label'] === 'Aksi')
                            <div class="flex justify-end gap-3 border-t border-blue-100 pt-3 mt-3 dark:border-gray-700">
                                <x-tombol-aksi 
                                    :showPrint="$btnPrint" 
                                    :showDetail="$btnShow" 
                                    :showEdit="$btnEdit"
                                    :showDelete="$btnDelete" 
                                    idx="{{ $item->id }}" 
                                />
                            </div>
                        @elseif ($header['label'] === 'Foto')
                            <div class="mb-3 flex justify-center">
                                @if ($item->foto)
                                    <img src="{{ asset('storage/' . $item->foto) }}" alt="Foto"
                                        class="h-20 w-20 rounded-xl object-cover shadow-sm border-2 border-white dark:border-gray-700">
                                @else
                                    <div class="h-20 w-20 rounded-xl bg-gray-200 flex items-center justify-center text-gray-400 dark:bg-gray-700 dark:text-gray-500">
                                        <i class="fa-solid fa-user text-2xl"></i>
                                    </div>
                                @endif
                            </div>
                        @else
                            <div class="mb-2 grid grid-cols-3 gap-2">
                                <span class="text-xs text-gray-400 uppercase tracking-wider font-medium dark:text-gray-500">{{ $header['label'] }}</span>
                                <span class="col-span-2 text-sm text-gray-800 font-medium wrap-break-word text-right dark:text-gray-200">
                                    {{ data_get($item, $header['key'], '-') }}
                                </span>
                            </div>
                        @endif
                    @endforeach
                </div>
            @empty
                <div class="text-center text-gray-500 text-sm py-8 border border-dashed rounded-lg bg-white shadow-sm dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400">
                    Tidak ada data ditemukan.
                </div>
            @endforelse
        </div>
    </div>

    {{-- Nomor halaman --}}
    <div class="mt-4 flex justify-center sm:justify-end">
        {{ $konten->withQueryString()->links() }}
    </div>
</div>