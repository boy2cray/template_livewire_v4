<?php

namespace Database\Seeders;

use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $karyawan = Karyawan::firstOrCreate(
            ['nik' => '1234567890123456'],
            [
                'nama'          => 'Super Administrator',
                'jk'            => 'L',
                'asal'          => 'Kantor Desa',
                'tgl_lahir'     => '2000-01-01',
                'alamat'       => 'Indonesia'
            ]
        );

        User::firstOrCreate(
            ['email'            => 'admin@admin.com'], // Username sebagai penanda unik
            [
                'id_karyawan'   => $karyawan->id,
                'password'      => 'admin',
                'otoritas'      => 'su' 
            ]
        );
    }
}
