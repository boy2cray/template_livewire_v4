@props([
    'title' => 'Judul Halaman',
    'description' => 'Keterangan singkat halaman',
    'addbutton' => true,
    'buttonLabel' => 'Tambah Data',
    'buttonIcon' => 'plus',
    'idModal' => 'modalTambah',
    'showImport' => false,
    'idImport' => 'modalImport'
])

<div class="flex mb-4 flex-col sm:flex-row sm:items-center sm:justify-between gap-3 bg-white p-4 sm:p-6 rounded-xl shadow-md border border-gray-100 transition-colors duration-300
    dark:bg-gray-800 dark:border-gray-700 dark:shadow-gray-900/20">
    
    <div>
        {{-- text-gray-800 -> dark:text-white (Judul jadi putih) --}}
        <h1 class="text-lg sm:text-2xl font-semibold text-gray-800 flex items-center gap-2 dark:text-white">
            {{ $title }}
        </h1>
        {{-- text-gray-500 -> dark:text-gray-400 (Deskripsi jadi abu-abu muda) --}}
        <p class="text-sm text-gray-500 mt-1 dark:text-gray-400">{{ $description }}</p>
    </div>

    @if ($addbutton)
        <div class="flex flex-col sm:flex-row sm:justify-end gap-2">
            
            {{-- Tombol tambah --}}
            {{-- Warna tombol (bg-blue-600) biasanya sudah cukup kontras di dark mode, 
                 tapi kita bisa tambahkan dark:hover:bg-blue-500 jika ingin efek hover lebih terang --}}
            <a @click.prevent="{{ $idModal }} = true" href="javascript:void(0)"
                class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow transition-all duration-200 ease-in-out w-full sm:w-auto text-center dark:bg-blue-600 dark:hover:bg-blue-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                <span>{{ $buttonLabel }}</span>
            </a>

            @if ($showImport)
                {{-- Tombol Import Excel --}}
                <a @click.prevent="{{ $idImport }} = true" href="javascript:void(0)"
                    class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg shadow transition-all duration-200 ease-in-out w-full sm:w-auto text-center dark:bg-green-600 dark:hover:bg-green-500">
                    <i class="fa-solid fa-file-excel"></i>
                    <span>Import Excel</span>
                </a>
            @endif
            
        </div>
    @endif
</div>