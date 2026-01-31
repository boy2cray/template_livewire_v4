<div class="min-h-screen flex items-center justify-center bg-linear-to-br from-blue-200 via-white to-blue-300 p-6 
    dark:from-gray-950 dark:via-gray-900 dark:to-black">

    <form wire:submit.prevent="login" class="w-full max-w-md">

        <div class="bg-white/70 backdrop-blur-xl p-8 md:p-10 rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.1)] border border-white/40
            dark:bg-gray-900/60 dark:border-gray-700 dark:shadow-none">

            <div class="flex justify-center mb-6">
                <div class="h-20 w-20 rounded-full bg-white shadow-md p-3 flex items-center justify-center 
                    dark:bg-gray-800 dark:shadow-gray-900/50">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-full w-auto object-contain">
                </div>
            </div>
            
            <h2 class="text-3xl font-extrabold text-center text-gray-800 mb-2 tracking-tight dark:text-white">
                ARTEK
            </h2>
            <p class="text-center text-sm text-gray-600 mb-8 dark:text-gray-400">
                Selamat Datang, Masuk untuk melanjutkan ke sistem.
            </p>

            <div class="mb-5">
                <label for="email" class="block text-sm font-medium text-gray-800 mb-1 dark:text-gray-300">Email</label>
                <input type="email" id="email" wire:model="email" 
                    class="block w-full px-4 py-3 rounded-xl border border-gray-400 bg-white text-gray-900
                            placeholder-gray-500 shadow-sm
                            focus:border-blue-600 focus:ring-2 focus:ring-blue-300 focus:outline-none transition
                            dark:bg-gray-800 dark:border-gray-600 dark:text-white dark:placeholder-gray-500 dark:focus:ring-blue-500/50"
                    placeholder="email@anda.com">

                @error('email') 
                    <span class="text-red-500 text-xs mt-1 dark:text-red-400">{{ $message }}</span> 
                @enderror
            </div>

            <div class="mb-8">
                <label for="password" class="block text-sm font-medium text-gray-800 mb-1 dark:text-gray-300">Password</label>
                <input type="password" id="password" wire:model="password" 
                    class="block w-full px-4 py-3 rounded-xl border border-gray-400 bg-white text-gray-900
                            placeholder-gray-500 shadow-sm
                            focus:border-blue-600 focus:ring-2 focus:ring-blue-300 focus:outline-none transition
                            dark:bg-gray-800 dark:border-gray-600 dark:text-white dark:placeholder-gray-500 dark:focus:ring-blue-500/50"
                    placeholder="••••••••">
                
                @error('password') 
                    <span class="text-red-500 text-xs mt-1 dark:text-red-400">{{ $message }}</span> 
                @enderror
            </div>

            <button type="submit" 
                    class="w-full flex justify-center py-3 px-4 rounded-xl shadow-lg font-semibold text-white
                           bg-linear-to-r from-blue-600 to-blue-800 
                           hover:from-blue-700 hover:to-blue-900
                           focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500
                           active:scale-[0.98] transition-all duration-300
                           dark:from-blue-700 dark:to-blue-900 dark:hover:from-blue-600 dark:hover:to-blue-800">
                
                <span wire:loading.remove wire:target="login">
                    Login
                </span>
                <span wire:loading wire:target="login">
                    Memproses...
                </span>
            </button>

        </div>

        <div class="mt-6 text-center">
            <p class="text-sm text-gray-700 dark:text-gray-400">
                Belum punya akun? 
                <a href="/register" wire:navigate 
                   class="font-medium text-blue-700 hover:text-blue-900 hover:underline transition
                   dark:text-blue-400 dark:hover:text-blue-300">
                    Daftar di sini
                </a>
            </p>
        </div>

    </form>
</div>