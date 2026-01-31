<div class="min-h-screen bg-gray-50 dark:bg-gray-900 pb-12 transition-colors" x-data="{ activeTab: 'pribadi' }">
    
    {{-- Header Banner (Mobile: Pendek, Desktop: Tinggi) --}}
    <div class="h-32 md:h-48 bg-linear-to-br from-blue-600 to-indigo-700 dark:from-blue-900 dark:to-gray-900 shadow-md rounded-2xl"></div>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 -mt-16 md:-mt-24">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            
            {{-- BAGIAN KIRI: KARTU PROFIL UTAMA --}}
            <div class="lg:col-span-4">
                <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-xl border border-gray-100 dark:border-gray-700 p-6 text-center">
                    
                    {{-- Foto Profil --}}
                    <div class="relative inline-block">
                        <div class="relative group">
                            @if ($newPhoto)
                                <img class="w-32 h-32 md:w-40 md:h-40 rounded-full border-4 border-white dark:border-gray-700 object-cover shadow-lg" src="{{ $newPhoto->temporaryUrl() }}">
                            @else
                                <img class="w-32 h-32 md:w-40 md:h-40 rounded-full border-4 border-white dark:border-gray-700 object-cover shadow-lg" src="{{ asset('storage/' . $karyawan->file) }}">
                            @endif

                            {{-- Tombol Edit Foto --}}
                            <label for="upload-photo" class="absolute bottom-1 right-1 bg-indigo-600 text-white p-2.5 rounded-full shadow-lg cursor-pointer hover:bg-indigo-700 transition-transform active:scale-90 border-2 border-white dark:border-gray-800">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                </svg>
                                <input type="file" id="upload-photo" wire:model="newPhoto" class="hidden" accept="image/*">
                            </label>
                        </div>
                    </div>

                    {{-- Nama & Jabatan --}}
                    <div class="mt-4">
                        <h2 class="text-xl md:text-2xl font-bold text-gray-900 dark:text-white uppercase tracking-tight leading-tight">
                            {{ $this->karyawan->nama }}
                        </h2>
                        <p class="text-indigo-600 dark:text-indigo-400 font-medium text-sm mt-1 uppercase tracking-widest">NIK: {{ $this->karyawan->nik }}</p>
                    </div>

                    {{-- Action Buttons (Simpan/Batal) --}}
                    @if ($newPhoto)
                        <div class="flex gap-2 mt-6">
                            <button wire:click="updatePhoto" class="flex-1 bg-green-600 text-white py-2 rounded-xl text-sm font-bold shadow-md">Simpan</button>
                            <button wire:click="$set('newPhoto', null)" class="flex-1 bg-gray-100 text-gray-600 py-2 rounded-xl text-sm font-bold">Batal</button>
                        </div>
                    @endif

                    <div class="mt-6 pt-6 border-t border-gray-100 dark:border-gray-700 flex flex-col gap-3 text-left">
                        <div class="flex items-center gap-3 text-gray-600 dark:text-gray-400">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                            <span class="text-sm truncate">{{ $this->karyawan->user->email }}</span>
                        </div>
                        <button @click.prevent="modalPwd = true" class="w-full mt-2 flex items-center justify-center gap-2 py-3 px-4 rounded-2xl bg-gray-50 dark:bg-gray-700/50 text-gray-700 dark:text-gray-400 text-sm font-semibold hover:bg-gray-100  transition">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                            Ganti Password
                        </button>
                    </div>
                </div>
            </div>

            {{-- BAGIAN KANAN: KONTEN DINAMIS --}}
            <div class="lg:col-span-8 space-y-6">
                
                {{-- Tab Navigation (Mobile: Scrollable) --}}
                <div class="bg-white dark:bg-gray-800 p-1.5 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 flex overflow-x-auto no-scrollbar">
                    <button @click="activeTab = 'pribadi'" :class="activeTab === 'pribadi' ? 'bg-indigo-600 text-white shadow-md' : 'text-gray-500 hover:text-gray-700 dark:text-gray-400'" class="flex-none md:flex-1 py-2.5 px-6 rounded-xl text-sm font-bold transition-all duration-200">
                        Profil
                    </button>
                    <button @click="activeTab = 'pekerjaan'" :class="activeTab === 'pekerjaan' ? 'bg-indigo-600 text-white shadow-md' : 'text-gray-500 hover:text-gray-700 dark:text-gray-400'" class="flex-none md:flex-1 py-2.5 px-6 rounded-xl text-sm font-bold transition-all duration-200">
                        Riwayat
                    </button>
                    <button @click="activeTab = 'dokumen'" :class="activeTab === 'dokumen' ? 'bg-indigo-600 text-white shadow-md' : 'text-gray-500 hover:text-gray-700 dark:text-gray-400'" class="flex-none md:flex-1 py-2.5 px-6 rounded-xl text-sm font-bold transition-all duration-200">
                        Berkas
                    </button>
                </div>

                {{-- Tab Content Card --}}
                <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden">
                    
                    {{-- Tab 1: Informasi Pribadi --}}
                    <div x-show="activeTab === 'pribadi'" class="p-6 md:p-8 space-y-6 animate-fade-in">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white flex items-center gap-2">
                            <span class="w-1.5 h-6 bg-indigo-600 rounded-full"></span>
                            Biodata Lengkap
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="p-4 bg-gray-50 dark:bg-gray-700/50 rounded-2xl border border-gray-100 dark:border-gray-600">
                                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Alamat Lengkap</p>
                                <p class="text-sm text-gray-800 dark:text-gray-200 leading-relaxed font-medium">{{ $this->karyawan->alamat ?? 'Data tidak tersedia' }}</p>
                            </div>
                            <div class="p-4 bg-gray-50 dark:bg-gray-700/50 rounded-2xl border border-gray-100 dark:border-gray-600">
                                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Telepon/WA</p>
                                <p class="text-sm text-gray-800 dark:text-gray-200 leading-relaxed font-medium">{{ $this->karyawan->no_telp ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Tab 2: Riwayat (Tabel Responsive) --}}
                    <div x-show="activeTab === 'pekerjaan'" class="p-0 animate-fade-in">
                        <div class="p-6 md:p-8 border-b border-gray-100 dark:border-gray-700">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white flex items-center gap-2">
                                <span class="w-1.5 h-6 bg-indigo-600 rounded-full"></span>
                                Riwayat Pekerjaan
                            </h3>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead class="bg-gray-50 dark:bg-gray-900/50 text-gray-500 dark:text-gray-400 text-xs font-bold uppercase tracking-wider">
                                    <tr>
                                        <th class="px-6 py-4">Posisi</th>
                                        <th class="px-6 py-4">Masa Kerja</th>
                                        <th class="px-6 py-4 text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                        <td class="px-6 py-4 text-sm font-semibold text-gray-700 dark:text-gray-200">Marketing Specialist</td>
                                        <td class="px-6 py-4 text-sm text-gray-500">2021 - Sekarang</td>
                                        <td class="px-6 py-4 text-center">
                                            <span class="bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-200 px-3 py-1 rounded-full text-[10px] font-bold uppercase">Aktif</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
