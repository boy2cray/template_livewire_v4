<script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/focus@3.x.x/dist/cdn.min.js"></script>

<script>
    document.addEventListener('livewire:initialized', () => {
        // Notifikasi konfirmasi delete
        window.addEventListener('show-delete-confirmation', event => {
            Swal.fire({
                title: "Yakin ingin menghapus?",
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Batal",
                confirmButtonColor: "red",
                cancelButtonColor: "blue"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Trigger deleteConfirmed() Livewire
                    Livewire.dispatch('deleteConfirmed');
                }
            });
        });

        // Notifikasi SweetAlert (Kode Anda yang sudah ada)
        window.addEventListener('notify', event => {
            Swal.fire({
                title: 'Berhasil!',
                text: event.detail.message, 
                icon: 'success',
                timer: 3000,
                timerProgressBar: true,
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
            });
        });

        // Notifikasi SweetAlert
        Livewire.on('show-alert', (event) => {
            Swal.fire({
                icon: event.type,
                title: event.type === 'error' ? 'Oops...' : 'Berhasil',
                text: event.message,
                timer: 3000,
                showConfirmButton: false
            });
           
        });

       //Logika untuk menampilkan loding halaman
        const pageLoader = document.getElementById('page-loader');

        if (pageLoader) {
            
            // Tampilkan loader saat navigasi dimulai
            window.addEventListener('livewire:navigate', () => {
                pageLoader.classList.remove('hidden');
                pageLoader.classList.add('flex'); 
            });

            // Sembunyikan loader saat navigasi selesai
            window.addEventListener('livewire:navigated', () => {
                pageLoader.classList.add('hidden');
                pageLoader.classList.remove('flex');
            });

            // Opsional: Sembunyikan loader jika terjadi error navigasi
            window.addEventListener('livewire:navigation-error', () => {
                pageLoader.classList.add('hidden');
                pageLoader.classList.remove('flex');
            });
        }
    });
</script>

<script>
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', event => {
        if (!('theme' in localStorage)) {
            if (event.matches) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        }
    });
</script>