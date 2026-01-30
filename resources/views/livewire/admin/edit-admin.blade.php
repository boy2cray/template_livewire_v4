<x-modal-input
    idModal='modalEdit'
    icon='edit'
    labelModal='Edit Data Admin'
    clickEvent='editData'
    buttonLabel='Edit'
    ukuran='max-w-2xl'
>

    <x-err-validation/>

    <x-floating-input
        wire:model="edit_nama"
        name="edit_nama"
        label="Nama pengguna"
        icon="user"
        :readonly="true"
    />

    <x-floating-input
        wire:model="edit_email"
        name="edit_email"
        label="Akun/Email"
        type="email"
        icon="email"
        :readonly="true"
    />

    <p class="mt-8 mb-4 border-l-8 border-blue-500 pl-2">Kosongkan jika tidak ingin merubah password</p>

    <x-floating-input
        wire:model="edit_password"
        name="edit_password"
        label="Password"
        type="password"
        icon="kunci"
    />

    <x-floating-input
        wire:model="edit_password_confirmation"
        name="edit_password_confirmation"
        label="Konfirmasi Password"
        type="password"
        icon="kunci"
    />

    <x-floating-input
        name="edit_otoritas"
        wire:model="edit_otoritas"
        label="Otoritas"
        icon="id"
        type="select"
        :options="['su' => 'Superuser', 'admin' => 'Admin', 'user' => 'User']"
    />
    
</x-modal-input>