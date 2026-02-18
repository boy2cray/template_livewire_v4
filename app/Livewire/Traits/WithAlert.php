<?php

namespace App\Livewire\Traits;

trait WithAlert
{
    protected function alert(
        string $type,
        string $message,
        array $options = []
    ): void {

        $payload = array_merge([
            'type'    => $type,
            'message' => $message,
            'title'   => match ($type) {
                'error'   => 'Oops...',
                'warning' => 'Perhatian',
                'info'    => 'Informasi',
                default   => 'Berhasil'
            },
            'toast'   => in_array($type, ['success', 'info']),
            'confirm' => false,
            // Mengambil ID unik komponen untuk keperluan callback
            'componentId' => $this->getId(), 
        ], $options);

        // Mengirim payload sebagai satu objek utuh, bukan argumen terpisah
        $this->dispatch('app:alert', $payload);
    }
}