<x-modal-kosong
    idModal='modalImport'
    icon='import'
    labelModal='Import Data Karyawan'
    ukuran='max-w-4xl'
>

<div class="md:p-6 space-y-6">

    <!-- Card Tutorial -->
    <div class="p-6 bg-white rounded-xl border border-gray-200 shadow-sm 
        dark:bg-gray-900 dark:border-gray-700 dark:shadow-none
    ">
        <h2 class="text-xl font-semibold text-gray-800 mb-3 dark:text-gray-100">Tutorial:</h2>

        <ul class="text-sm text-gray-700 list-disc list-inside space-y-1 dark:text-gray-300">
            <li>
                Download Template Excel: 
                <a href="{{ asset('templates/'. $fileExcel) }}" 
                   class="text-blue-600 hover:underline font-medium dark:text-blue-400">
                    Download
                </a>
            </li>
            <li>Isi file Excel dan jangan mengubah header</li>
            <li>Upload file menggunakan dropzone di bawah</li>
            <li>Klik tombol <strong>Import Data</strong></li>
        </ul>
    </div>

    {{-- Notifikasi sukses --}}
    @if (session('success'))
        <div class="flex items-center p-4 text-sm 
            text-green-800 bg-green-50 rounded-lg 
            dark:text-green-300 dark:bg-green-900/20
        " role="alert">
            <svg class="shrink-0 inline w-4 h-4 mr-3 text-green-600 dark:text-green-400" 
                 aria-hidden="true" xmlns="http://www.w3.org/2000/svg" 
                 fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
            </svg>
            <div>
                <span class="font-medium">Sukses!</span> {{ session('success') }}
            </div>
        </div>
    @endif

    {{-- Form Import --}}
    <form wire:submit.prevent="import" class="space-y-4">

        <div>
            {{-- Dropzone --}}
            <label for="file-upload" 
                class="flex flex-col items-center justify-center w-full h-48 
                    border-2 border-gray-300 border-dashed rounded-lg cursor-pointer
                    bg-gray-50 hover:bg-gray-100 
                    dark:bg-gray-800 dark:hover:bg-gray-700 
                    dark:border-gray-600
                ">
                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                    <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" 
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" 
                        viewBox="0 0 20 16">
                        <path stroke="currentColor" stroke-linecap="round" 
                            stroke-linejoin="round" stroke-width="2" 
                            d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                    </svg>

                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-300">
                        <span class="font-semibold">Klik untuk mengunggah</span> atau seret dan lepas
                    </p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">
                        XLS, XLSX, atau CSV (Maks. 5MB)
                    </p>
                </div>

                <input id="file-upload" wire:model="file" type="file" class="hidden" />
            </label>

            {{-- File name --}}
            @if ($file)
                <div class="mt-2 text-sm text-gray-600 dark:text-gray-300">
                    File dipilih: 
                    <span class="font-medium">{{ $file->getClientOriginalName() }}</span>
                </div>
            @endif

            {{-- Error file --}}
            @error('file')
                <span class="block mt-1 text-red-600 text-sm dark:text-red-400">{{ $message }}</span>
            @enderror
        </div>

        {{-- Tombol Submit --}}
        <button class="w-full flex items-center justify-center px-4 py-2.5 
                bg-blue-600 text-white rounded-lg 
                hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 
                disabled:bg-blue-400 disabled:cursor-not-allowed

                dark:bg-blue-700 dark:hover:bg-blue-600 
                dark:focus:ring-blue-900
            "
            type="submit"
            wire:loading.attr="disabled"
            wire:target="import">

            {{-- Spinner --}}
            <svg wire:loading wire:target="import" 
                class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" 
                xmlns="http://www.w3.org/2000/svg" fill="none" 
                viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" 
                        stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" 
                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>

            {{-- Ikon normal --}}
            <svg wire:loading.remove wire:target="import" 
                class="w-5 h-5 mr-2 -ml-1 text-white" 
                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" 
                fill="currentColor">
                <path fill-rule="evenodd" 
                    d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6 12a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zM6 8a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zM6 4a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1z" 
                    clip-rule="evenodd" />
            </svg>

            <span>Import Data</span>
        </button>
    </form>

    {{-- Laporan Data Gagal --}}
    @if(count($failures) > 0)
        <div class="mt-6 p-4 border border-red-300 bg-red-50 rounded-lg
            dark:border-red-700 dark:bg-red-900/20
        ">
            <h3 class="font-semibold text-red-800 mb-3 dark:text-red-300">
                <svg class="inline w-5 h-5 mr-1 text-red-600 dark:text-red-400" 
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" 
                    fill="currentColor">
                    <path fill-rule="evenodd" 
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" 
                        clip-rule="evenodd" />
                </svg>
                Beberapa data gagal diimpor:
            </h3>

            <div class="overflow-x-auto relative shadow-sm sm:rounded-lg 
                border border-red-200 dark:border-red-700
            ">
                <table class="w-full min-w-full text-sm text-left 
                    text-red-900 dark:text-red-200
                ">
                    <thead class="text-xs text-red-900 uppercase bg-red-200 
                        dark:bg-red-800 dark:text-red-200
                    ">
                        <tr>
                            <th class="px-4 py-3">Baris</th>
                            <th class="px-4 py-3">Kolom</th>
                            <th class="px-4 py-3">Pesan Error</th>
                            <th class="px-4 py-3">Data</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($failures as $fail)
                        <tr class="bg-white border-b border-red-200 
                            last:border-b-0 
                            dark:bg-gray-900 dark:border-red-800
                        ">
                            <td class="px-4 py-3 font-medium">{{ $fail['row'] }}</td>
                            <td class="px-4 py-3">{{ $fail['attribute'] }}</td>
                            <td class="px-4 py-3">{{ implode(', ', $fail['errors']) }}</td>
                            <td class="px-4 py-3">
                                <code class="text-xs break-all dark:text-red-300">
                                    {{ json_encode($fail['values']) }}
                                </code>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    @endif

</div>

</x-modal-kosong>