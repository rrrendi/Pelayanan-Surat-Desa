<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'password' => bcrypt('admin123'),
            'nik' => '1234567890123456',
            'alamat' => 'Kantor Desa',
            'tempat_lahir' => 'Bandung',
            'tanggal_lahir' => '1990-01-01',
            'jenis_kelamin' => 'Laki-laki',
            'agama' => 'Islam',
            'pekerjaan' => 'Perangkat Desa',
            'status_perkawinan' => 'Kawin',
        ]);

        User::factory()->create([
            'name' => 'Warga Contoh',
            'email' => 'warga@gmail.com',
            'role' => 'warga',
            'password' => bcrypt('warga123'),
            'nik' => '3201234567890001',
            'alamat' => 'Dusun 1 RT 01 RW 01',
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '1995-05-20',
            'jenis_kelamin' => 'Laki-laki',
            'agama' => 'Islam',
            'pekerjaan' => 'Wiraswasta',
            'status_perkawinan' => 'Belum Kawin',
        ]);

        $this->call(SuratJenisSeeder::class);
    }
}