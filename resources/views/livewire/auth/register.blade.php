<div class="min-h-screen flex items-center justify-center bg-linear-to-br from-blue-100 via-white to-blue-200 p-6 
    dark:from-gray-950 dark:via-gray-900 dark:to-black">

    <form wire:submit.prevent="register" class="w-full max-w-md">

        <div class="bg-linear-to-br from-white to-blue-100 p-8 md:p-10 rounded-3xl shadow-2xl border border-white/40
            dark:bg-none dark:bg-gray-900/60 dark:backdrop-blur-xl dark:border-gray-700 dark:shadow-none">

            <div class="text-center pb-4 border-b-4 border-blue-500 mb-6 dark:border-blue-600">
                <div class="flex justify-center mb-3 text-blue-600 dark:text-blue-500">
                    <i class="fa-solid fa-users text-4xl"></i>
                </div>
                <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Buat Akun Baru</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Hanya nama yang terdaftar yang dapat membuat akun</p>
            </div>

            {{-- PESAN ERROR --}}
            @if ($errors->any())
                <div class="p-4 mb-6 bg-red-50 border border-red-200 text-red-700 rounded-xl text-sm
                    dark:bg-red-900/20 dark:border-red-800 dark:text-red-300">
                    <strong class="font-semibold flex items-center gap-2">
                        <i class="fa-solid fa-triangle-exclamation"></i> Terjadi kesalahan:
                    </strong>
                    <ul class="mt-2 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- FORM INPUTS --}}
            <div class="space-y-2">
                
                {{-- Search Select Dosen --}}
                <div class="mb-4">
                    {{-- Pastikan komponen ini support dark mode di view internalnya --}}
                    <livewire:part.search-select 
                        wire:model="id_karyawan" 
                        model="App\Models\Karyawan" 
                        searchField="nama" 
                        valueField="id" 
                        labelField="Nama Karyawan" 
                        kodeField="nik"
                        placeholder="Cari Karyawan..."
                        errorKey="id_karyawan"
                    />
                </div>

                <x-floating-input
                    wire:model="email"
                    name="email"
                    label="Akun/Email"
                    type="email"
                    icon="email"
                    :floating="false"
                />

                <x-floating-input
                    wire:model="password"
                    name="password"
                    label="Password"
                    type="password"
                    icon="kunci"
                    :floating="false"
                />

                <x-floating-input
                    wire:model="password_confirmation"
                    name="password_confirmation"
                    label="Konfirmasi Password"
                    type="password"
                    icon="kunci"
                    :floating="false"
                />
            </div>

            <div class="border-t-4 border-blue-500 pt-6 mt-6 dark:border-blue-600">
                <button type="submit" 
                        class="w-full flex justify-center py-3 px-4 rounded-xl shadow-lg font-semibold text-white
                               bg-linear-to-r from-blue-600 to-blue-800 
                               hover:from-blue-700 hover:to-blue-900
                               focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500
                               active:scale-[0.98] transition-all duration-300
                               dark:from-blue-700 dark:to-blue-900 dark:hover:from-blue-600 dark:hover:to-blue-800">
                    
                    <span wire:loading.remove wire:target="register">
                        Daftar Sekarang
                    </span>
                    <span wire:loading wire:target="register" class="flex items-center gap-2">
                        <i class="fa-solid fa-spinner fa-spin"></i> Memproses...
                    </span>
                </button>
            </div>
        </div>

        <div class="mt-8 text-center">
            <p class="text-sm text-gray-700 dark:text-gray-400">
                Sudah punya akun? 
                <a href="{{ route('login') }}" wire:navigate 
                   class="font-medium text-blue-700 hover:text-blue-900 hover:underline transition
                   dark:text-blue-400 dark:hover:text-blue-300">
                    Login di sini
                </a>
            </p>
        </div>

    </form>
</div>