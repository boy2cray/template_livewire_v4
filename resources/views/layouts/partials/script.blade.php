<script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/focus@3.x.x/dist/cdn.min.js"></script>

<script>
    document.addEventListener('livewire:initialized', () => {

        if (window.__alertEngineLoaded) return;
        window.__alertEngineLoaded = true;

        let queue = [];
        let isShowing = false;

        function processQueue() {
            if (isShowing || queue.length === 0) return;

            isShowing = true;
            const data = queue.shift();
            const isDark = document.documentElement.classList.contains('dark');

            // Pengaturan dasar SweetAlert2
            const swalConfig = {
                title: data.title,
                text: data.message,
                icon: data.type,
                background: isDark ? '#1f2937' : '#fff',
                color: isDark ? '#e5e7eb' : '#111827',
                ...data // Spread data tambahan dari PHP
            };

            if (data.confirm) {
                Swal.fire({
                    ...swalConfig,
                    showCancelButton: true,
                    confirmButtonText: 'Lanjutkan',
                    cancelButtonText: 'Batal',
                }).then(result => {
                    if (result.isConfirmed && data.onConfirm) {
                        // Mencari komponen spesifik yang mengirim alert berdasarkan ID
                        const component = Livewire.find(data.componentId);
                        if (component) {
                            component.call(data.onConfirm);
                        } else {
                            // Fallback jika ID tidak ditemukan (opsional)
                            Livewire.dispatch(data.onConfirm);
                        }
                    }
                    isShowing = false;
                    processQueue();
                });
                return;
            }

            // Standar Alert / Toast
            Swal.fire({
                ...swalConfig,
                toast: data.toast,
                position: data.toast ? 'top-end' : 'center',
                timer: data.toast ? 3000 : undefined,
                showConfirmButton: !data.toast,
            }).then(() => {
                isShowing = false;
                processQueue();
            });
        }

        // Listener Event Livewire v3
        Livewire.on('app:alert', (event) => {
            // Normalisasi payload v3 
            const data = event[0] || event;
            queue.push(data);
            processQueue();
        });

        // Fitur Page Loader (Dipertahankan)
        const pageLoader = document.getElementById('page-loader');
        if (pageLoader) {
            window.addEventListener('livewire:navigate', () => {
                pageLoader.classList.remove('hidden');
                pageLoader.classList.add('flex'); 
            });

            window.addEventListener('livewire:navigated', () => {
                pageLoader.classList.add('hidden');
                pageLoader.classList.remove('flex');
            });

            window.addEventListener('livewire:navigation-error', () => {
                pageLoader.classList.add('hidden');
                pageLoader.classList.remove('flex');
            });
        }
    });

    // Listener Dark Mode 
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