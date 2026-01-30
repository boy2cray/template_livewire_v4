@props([
    'label' => null,
    'accept' => 'image/*',
    'maxSize' => 2
])

<div class="w-full" x-data="{ uploading: false, progress: 0 }" 
     x-on:livewire-upload-start="uploading = true"
     x-on:livewire-upload-finish="uploading = false"
     x-on:livewire-upload-error="uploading = false"
     x-on:livewire-upload-progress="progress = $event.detail.progress">
    
    @if($label)
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ $label }}
        </label>
    @endif

    <div class="relative w-full min-h-35 border-2 border-dashed rounded-xl flex items-center justify-center p-4 transition-all duration-200
        {{ $errors->has($attributes->get('wire:model')) 
            ? 'border-red-500 bg-red-50 dark:bg-red-900/10' 
            : 'border-gray-300 dark:border-gray-700 dark:bg-gray-800 hover:border-blue-400 dark:hover:border-blue-500' 
        }}">
        
        {{-- Input File Utama --}}
        <input type="file" {{ $attributes }} 
               class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10"
               accept="{{ $accept }}">

        <div class="text-center w-full">
            @php $modelName = $attributes->get('wire:model'); @endphp
            
            {{-- Menggunakan $this untuk mengakses properti di Parent Livewire --}}
            @if ($this->$modelName)
                <div class="flex flex-col items-center space-y-3">
                    <div class="relative group">
                        {{-- Logika Pengganti @try: Cek method dan tipe mime --}}
                        @if (method_exists($this->$modelName, 'temporaryUrl') && str_starts_with($this->$modelName->getMimeType(), 'image/'))
                            <img src="{{ $this->$modelName->temporaryUrl() }}" 
                                 class="h-24 w-24 object-cover rounded-xl shadow-md border-2 border-white dark:border-gray-600">
                        @else
                            <div class="h-20 w-20 flex items-center justify-center bg-blue-100 dark:bg-blue-900/30 rounded-xl">
                                <svg class="w-10 h-10 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                        @endif
                    </div>
                    
                    <div class="z-20">
                        <p class="text-xs font-bold text-gray-800 dark:text-gray-200 truncate max-w-45 mx-auto">
                            {{ method_exists($this->$modelName, 'getClientOriginalName') ? $this->$modelName->getClientOriginalName() : 'File Terpilih' }}
                        </p>
                        <button type="button" 
                                x-on:click="$wire.set('{{ $modelName }}', null)" 
                                class="mt-1 text-[10px] uppercase tracking-wider text-red-500 hover:text-red-600 font-bold bg-red-50 dark:bg-red-900/20 px-3 py-1 rounded-full transition">
                            Hapus File
                        </button>
                    </div>
                </div>
            @else
                {{-- Tampilan Kosong (Placeholder) --}}
                <div class="space-y-2">
                    <div class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500 bg-gray-100 dark:bg-gray-700/50 rounded-full flex items-center justify-center">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-blue-600 dark:text-blue-400 font-bold">Klik untuk unggah</p>
                        <p class="text-[10px] text-gray-500 dark:text-gray-400 uppercase">
                            Maksimal {{ $maxSize }}MB
                        </p>
                    </div>
                </div>
            @endif
        </div>

        {{-- Loading Overlay --}}
        <div x-show="uploading" class="absolute inset-0 bg-white/90 dark:bg-gray-900/90 flex flex-col items-center justify-center rounded-xl z-30">
            <div class="w-1/2 bg-gray-200 dark:bg-gray-700 rounded-full h-1.5 mb-2">
                <div class="bg-blue-600 h-1.5 rounded-full transition-all duration-300" :style="`width: ${progress}%`"></div>
            </div>
            <span class="text-[10px] font-black text-blue-600 dark:text-blue-400" x-text="progress + '%'"></span>
        </div>
    </div>

    @error($attributes->get('wire:model')) 
        <p class="text-xs text-red-500 mt-2 font-medium italic">{{ $message }}</p> 
    @enderror
</div>