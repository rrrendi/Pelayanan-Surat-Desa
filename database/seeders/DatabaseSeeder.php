<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\SuratJenis;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat Admin
        User::create([
            'name' => 'Admin Desa Sayati',
            'email' => 'admin@desa.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'nik' => '3201010101010001',
            'tempat_lahir' => 'Bandung',
            'tanggal_lahir' => '1980-01-01',
            'jenis_kelamin' => 'Laki-laki',
            'agama' => 'Islam',
            'pekerjaan' => 'Pegawai Negeri Sipil',
            'status_perkawinan' => 'Kawin',
            'alamat' => 'Kantor Desa Sayati, Jl. Raya Desa No. 1, Margahayu, Bandung'
        ]);

        // Buat Jenis Surat
        $jenisSurat = [
            ['nama_surat' => 'Surat Keterangan Domisili', 'keterangan' => 'Surat keterangan tempat tinggal yang sah'],
            ['nama_surat' => 'Surat Keterangan Usaha', 'keterangan' => 'Surat keterangan memiliki usaha/kegiatan ekonomi'],
            ['nama_surat' => 'Surat Keterangan Tidak Mampu', 'keterangan' => 'Surat keterangan kondisi ekonomi kurang mampu'],
            ['nama_surat' => 'Surat Keterangan Kelahiran', 'keterangan' => 'Surat keterangan kelahiran bayi'],
            ['nama_surat' => 'Surat Pengantar KTP', 'keterangan' => 'Surat pengantar pembuatan KTP baru'],
            ['nama_surat' => 'Surat Keterangan Penghasilan', 'keterangan' => 'Surat keterangan penghasilan per bulan'],
            ['nama_surat' => 'Surat Keterangan Belum Menikah', 'keterangan' => 'Surat keterangan status belum menikah'],
        ];

        foreach ($jenisSurat as $jenis) {
            SuratJenis::create($jenis);
        }
    }
}