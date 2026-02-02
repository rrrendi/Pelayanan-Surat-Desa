<?php

namespace Database\Seeders;

use App\Models\SuratJenis;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SuratJenisSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nama_surat' => 'Surat Keterangan Kematian',
                'keterangan' => 'Syarat: Fotokopi KTP Almarhum, KK Asli/Fotokopi, Surat Keterangan dari RS/Puskesmas (jika ada).'
            ],
            [
                'nama_surat' => 'Surat Pengantar SKCK',
                'keterangan' => 'Syarat: Fotokopi KTP, Fotokopi KK, Fotokopi Akta Kelahiran. Digunakan sebagai pengantar ke Polsek/Polres.'
            ],
            [
                'nama_surat' => 'Surat Keterangan Belum Kawin',
                'keterangan' => 'Syarat: Fotokopi KTP, Fotokopi KK, Surat Pernyataan Belum Menikah bermaterai.'
            ],
            [
                'nama_surat' => 'Surat Keterangan Kelahiran',
                'keterangan' => 'Syarat: Fotokopi KTP Orang Tua, KK, Surat Keterangan Lahir dari Bidan/RS.'
            ],
            [
                'nama_surat' => 'Surat Domisili Ibadah Haji',
                'keterangan' => 'Syarat: Fotokopi KTP, KK, Bukti Setoran Awal BPIH (jika sudah ada).'
            ],
            [
                'nama_surat' => 'Surat Keterangan Pindah Datang',
                'keterangan' => 'Syarat: Surat Pindah dari daerah asal (SKPWNI), KTP & KK Asli daerah asal.'
            ],
            [
                'nama_surat' => 'Surat Keterangan Ahli Waris',
                'keterangan' => 'Syarat: Surat Kematian, KTP & KK seluruh ahli waris, Surat Pernyataan Ahli Waris bermaterai.'
            ],
            [
                'nama_surat' => 'Surat Izin Rame-Rame (Keramaian)',
                'keterangan' => 'Syarat: Fotokopi KTP Penanggung Jawab, Proposal Kegiatan/Rundown Acara.'
            ],
            [
                'nama_surat' => 'Surat Domisili Perusahaan/Usaha',
                'keterangan' => 'Syarat: Fotokopi KTP Pemilik, Bukti Kepemilikan Tempat Usaha (Sewa/Milik Sendiri), Foto Tempat Usaha.'
            ],
            [
                'nama_surat' => 'Surat Pindah Keluar',
                'keterangan' => 'Syarat: KK Asli, KTP Asli, Alamat Lengkap Tujuan Pindah.'
            ],
            [
                'nama_surat' => 'Legalisir Dokumen',
                'keterangan' => 'Syarat: Membawa Dokumen Asli dan Fotokopi yang akan dilegalisir.'
            ],
            [
                'nama_surat' => 'Surat Keterangan Pensiunan',
                'keterangan' => 'Syarat: SK Pensiun Terakhir, KTP, KK, Pas Foto Terbaru.'
            ],
            [
                'nama_surat' => 'Surat Keterangan Izin Mendirikan Bangunan (IMB)',
                'keterangan' => 'Syarat: Fotokopi KTP, Bukti Kepemilikan Tanah (Sertifikat/AJB), Gambar Denah Bangunan.'
            ],
            [
                'nama_surat' => 'Surat Rekomendasi Puskesos',
                'keterangan' => 'Syarat: Fotokopi KTP, KK, Foto Rumah (Depan, Ruang Tamu, Dapur), Surat Keterangan Tidak Mampu (SKTM).'
            ],
            [
                'nama_surat' => 'Surat Keterangan Usaha (SKU)',
                'keterangan' => 'Syarat: Fotokopi KTP, KK, Jenis Usaha yang dijalankan.'
            ],
        ];

        foreach ($data as $item) {
            SuratJenis::create($item);
        }
    }
}