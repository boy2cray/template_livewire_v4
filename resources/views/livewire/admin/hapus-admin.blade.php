<x-modal-hapus
    idModal='modalHapus'
    labelModal='Hapus Data Admin'
    clickEvent='hapusData'
>

    <p class="text-sm mb-1">
        Nama:
        <span class="font-mono bg-gray-100 text-gray-900 dark:bg-gray-800 dark:text-gray-100 px-2 py-1 rounded">
            {{ $hapus_nama }}
        </span>
    </p>
    <p class="text-sm">
        Email:
        <span class="font-semibold text-gray-800 dark:text-gray-200">
            {{ $hapus_email }}
        </span>
    </p>

</x-base-modal>