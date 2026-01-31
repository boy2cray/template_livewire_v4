<?php

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

new class extends Component
{
    public function logout()
    {
        Auth::logout();

        // Hapus dan regenerasi sesi
        session()->invalidate();
        session()->regenerateToken();

        // Redirect ke halaman login
        return redirect()->route('login');
    }
};
?>

<div>
    <button 
        type="button"
        wire:click="logout" 
        class="flex items-center w-full gap-2 px-4 py-2 text-sm text-red-600 dark:text-red-400 bg-transparent dark:bg-transparent hover:bg-red-500 dark:hover:bg-red-600 hover:text-white dark:hover:text-white rounded-md transition focus:outline-none focus:ring-2 focus:ring-red-300 dark:focus:ring-red-700"
    >
        <i class="fas fa-sign-out-alt"></i> Logout
    </button>
</div>