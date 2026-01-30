<x-modal-hapus
    idModal='modalHapus'
    labelModal='Hapus Data Dosen'
    clickEvent='hapusData'
>

     <p class="text-sm mb-1">
        NIK :
        <span class="font-mono bg-gray-100 text-gray-900 dark:bg-gray-800 dark:text-gray-100 px-2 py-1 rounded">
            {{ $hapus_nik }}
        </span>
    </p>
    <p class="text-sm">
        Nama Karyawan :
        <span class="font-semibold text-gray-800 dark:text-gray-200">
            {{ $hapus_nama }}
        </span>
    </p>

</x-base-modal>