{{-- Validation Error --}}
@if ($errors->any())
    <div class="mb-6 rounded-xl border border-red-200 bg-red-50 dark:bg-red-950/40 dark:border-red-800 overflow-hidden">

        {{-- Header --}}
        <div class="flex items-center gap-3 px-4 py-3 border-b border-red-200 dark:border-red-800">
            <div class="flex items-center justify-center w-9 h-9 rounded-lg bg-red-100 dark:bg-red-900/50">
                {{-- Icon Warning --}}
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5 text-red-600 dark:text-red-400"
                    fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 9v4m0 4h.01M10.29 3.86l-7.4 12.8A2 2 0 004.63 20h14.74a2 2 0 001.74-3.34l-7.4-12.8a2 2 0 00-3.42 0z" />
                </svg>
            </div>

            <div>
                <h4 class="font-semibold text-red-700 dark:text-red-300">
                    Terjadi Kesalahan Validasi
                </h4>
                <p class="text-xs text-red-600 dark:text-red-400">
                    Silakan periksa kembali input yang Anda masukkan.
                </p>
            </div>
        </div>

        {{-- Body --}}
        <div class="px-5 py-4">
            <ul class="space-y-2 text-sm">
                @foreach ($errors->all() as $error)
                    <li class="flex items-start gap-2 text-red-700 dark:text-red-300">
                        <span class="mt-1 w-1.5 h-1.5 rounded-full bg-red-500"></span>
                        <span>{{ $error }}</span>
                    </li>
                @endforeach
            </ul>
        </div>

    </div>
@endif
