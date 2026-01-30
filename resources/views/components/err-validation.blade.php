{{-- Pesan Error --}}
@if ($errors->any())
    <div
        class="p-4 mb-4 rounded-lg border
            bg-red-50 border-red-200 text-red-700
            dark:bg-red-950/40 dark:border-red-800 dark:text-red-300">
        
        <strong class="font-semibold">
            Terjadi kesalahan:
        </strong>

        <ul class="mt-2 list-disc list-inside text-sm space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
