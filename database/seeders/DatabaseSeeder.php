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
            'alamat' => 'Kantor Desa Sayati, Jl. Raya Desa No. 1'
        ]);

        // Buat Warga 1
        User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@gmail.com',
            'password' => Hash::make('budi123'),
            'role' => 'warga',
            'nik' => '3201010101010002',
            'alamat' => 'Jl. Merdeka No. 123, RT 001/RW 002'
        ]);

        // Buat Warga 2
        User::create([
            'name' => 'Siti Nurhaliza',
            'email' => 'siti@gmail.com',
            'password' => Hash::make('siti123'),
            'role' => 'warga',
            'nik' => '3201010101010003',
            'alamat' => 'Jl. Sudirman No. 45, RT 003/RW 001'
        ]);

        // Buat Jenis Surat
        SuratJenis::create([
            'nama_surat' => 'Surat Keterangan Domisili',
            'keterangan' => 'Surat keterangan tempat tinggal yang sah'
        ]);

        SuratJenis::create([
            'nama_surat' => 'Surat Keterangan Usaha',
            'keterangan' => 'Surat keterangan memiliki usaha/kegiatan ekonomi'
        ]);

        SuratJenis::create([
            'nama_surat' => 'Surat Keterangan Tidak Mampu',
            'keterangan' => 'Surat keterangan kondisi ekonomi kurang mampu'
        ]);

        SuratJenis::create([
            'nama_surat' => 'Surat Keterangan Kelahiran',
            'keterangan' => 'Surat keterangan kelahiran bayi'
        ]);

        SuratJenis::create([
            'nama_surat' => 'Surat Pengantar KTP',
            'keterangan' => 'Surat pengantar pembuatan KTP baru'
        ]);
    }
}