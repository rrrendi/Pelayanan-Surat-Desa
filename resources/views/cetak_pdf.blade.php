<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Keterangan - {{ $surat->suratJenis->nama_surat }}</title>
    <style>
        /* Format Kertas A4 */
        @page {
            margin: 2.5cm 2.5cm 2.5cm 2.5cm;
            size: A4;
        }
        
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            line-height: 1.5;
            color: #000;
        }

        /* Kop Surat */
        .kop-surat {
            text-align: center;
            margin-bottom: 20px;
            position: relative;
            border-bottom: 3px double #000; /* Garis ganda di bawah kop */
            padding-bottom: 10px;
        }

        .logo {
            width: 75px;
            height: auto;
            position: absolute;
            left: 0;
            top: 0;
        }

        .kop-text {
            margin-left: 80px; /* Memberi ruang untuk logo */
            margin-right: 0px;
        }

        .pemerintah {
            font-size: 14pt;
            font-weight: bold;
            text-transform: uppercase;
            margin: 0;
        }

        .desa {
            font-size: 18pt;
            font-weight: bold;
            text-transform: uppercase;
            margin: 5px 0;
        }

        .alamat {
            font-size: 10pt;
            font-style: italic;
            margin: 0;
        }

        /* Isi Surat */
        .judul-surat {
            text-align: center;
            margin-top: 30px;
            margin-bottom: 30px;
        }

        .judul-surat h3 {
            text-decoration: underline;
            text-transform: uppercase;
            margin: 0;
            font-size: 14pt;
        }

        .nomor-surat {
            text-align: center;
            font-size: 11pt;
            margin-top: 2px;
        }

        .paragraf {
            text-align: justify;
            text-indent: 50px; /* Menjorok ke dalam */
            margin-bottom: 15px;
        }

        /* Tabel Biodata (Titik dua sejajar) */
        .table-biodata {
            width: 100%;
            margin-left: 20px;
            margin-bottom: 20px;
        }
        .table-biodata td {
            vertical-align: top;
            padding: 3px 0;
        }
        .label-col { width: 150px; }
        .sep-col { width: 20px; text-align: center; }

        /* Tanda Tangan */
        .tanda-tangan {
            float: right;
            width: 250px;
            text-align: center;
            margin-top: 50px;
        }
    </style>
</head>
<body>

    <div class="kop-surat">
        <img src="{{ public_path('images/logokap.png') }}" class="logo" alt="Logo">
        <div class="kop-text">
            <div class="pemerintah">PEMERINTAH KABUPATEN BANDUNG</div>
            <div class="pemerintah">KECAMATAN MARGAASIH</div>
            <div class="desa">DESA SAYATI</div>
            <div class="alamat">
                Jl. Raya Sayati No. 123, Kec. Margaasih, Kab. Bandung - Jawa Barat<br>
                Email: info@desasayati.go.id | Telp: (022) 1234567
            </div>
        </div>
    </div>

    <div class="judul-surat">
        <h3>{{ $surat->suratJenis->nama_surat }}</h3>
        <div class="nomor-surat">Nomor: 470 / {{ str_pad($surat->id, 3, '0', STR_PAD_LEFT) }} / DS / {{ date('Y') }}</div>
    </div>

    <div class="paragraf">
        Yang bertanda tangan di bawah ini Kepala Desa Sayati, Kecamatan Margaasih, Kabupaten Bandung, menerangkan dengan sebenarnya bahwa:
    </div>

    <table class="table-biodata">
        <tr>
            <td class="label-col">Nama Lengkap</td>
            <td class="sep-col">:</td>
            <td><b>{{ strtoupper($surat->user->name) }}</b></td>
        </tr>
        <tr>
            <td class="label-col">NIK</td>
            <td class="sep-col">:</td>
            <td>{{ $surat->user->nik }}</td>
        </tr>
        <tr>
            <td class="label-col">Tempat/Tgl Lahir</td>
            <td class="sep-col">:</td>
            <td>{{ $surat->user->tempat_lahir }}, {{ $surat->user->tanggal_lahir->format('d-m-Y') }}</td>
        </tr>
        <tr>
            <td class="label-col">Jenis Kelamin</td>
            <td class="sep-col">:</td>
            <td>{{ $surat->user->jenis_kelamin }}</td>
        </tr>
        <tr>
            <td class="label-col">Pekerjaan</td>
            <td class="sep-col">:</td>
            <td>{{ $surat->user->pekerjaan }}</td>
        </tr>
        <tr>
            <td class="label-col">Agama</td>
            <td class="sep-col">:</td>
            <td>{{ $surat->user->agama }}</td>
        </tr>
        <tr>
            <td class="label-col">Status Perkawinan</td>
            <td class="sep-col">:</td>
            <td>{{ $surat->user->status_perkawinan }}</td>
        </tr>
        <tr>
            <td class="label-col">Alamat</td>
            <td class="sep-col">:</td>
            <td>{{ $surat->user->alamat }}</td>
        </tr>
    </table>

    <div class="paragraf">
        Orang tersebut di atas adalah benar-benar warga penduduk Desa Sayati yang berdomisili di alamat tersebut. Berdasarkan data yang ada, surat ini diterbitkan untuk keperluan:
    </div>

    <div style="margin: 10px 40px; padding: 10px; border: 1px solid #000; background-color: #f9f9f9; font-style: italic;">
        "{{ $surat->keterangan }}"
    </div>

    <div class="paragraf">
        Demikian surat keterangan ini kami buat dengan sebenarnya agar dapat dipergunakan sebagaimana mestinya.
    </div>

    <div class="tanda-tangan">
        <div>Sayati, {{ date('d F Y') }}</div>
        <div style="margin-bottom: 80px;">Kepala Desa Sayati</div>
        
        <div style="font-weight: bold; text-decoration: underline;">H. KEPALA DESA</div>
        <div>NIP. 19700101 200003 1 001</div>
    </div>

</body>
</html>