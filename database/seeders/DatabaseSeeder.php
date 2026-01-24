<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\SuratJenis;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat Admin
        User::create([
            'name' => 'Admin Desa',
            'email' => 'admin@desa.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'nik' => '3201010101010001',
            'alamat' => 'Kantor Desa'
        ]);

        // Buat Warga
        User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@gmail.com',
            'password' => Hash::make('budi123'),
            'role' => 'warga',
            'nik' => '3201010101010002',
            'alamat' => 'Jl. Merdeka No. 123'
        ]);

        // Buat Jenis Surat
        SuratJenis::create([
            'nama_surat' => 'Surat Keterangan Domisili',
            'keterangan' => 'Surat keterangan tempat tinggal'
        ]);

        SuratJenis::create([
            'nama_surat' => 'Surat Keterangan Usaha',
            'keterangan' => 'Surat keterangan memiliki usaha'
        ]);

        SuratJenis::create([
            'nama_surat' => 'Surat Keterangan Tidak Mampu',
            'keterangan' => 'Surat keterangan kondisi ekonomi'
        ]);
    }
}