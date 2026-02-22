<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SURAT KETERANGAN SERBAGUNA</title>
    <style>
        /* Format Kertas A4 & Margins */
        @page {
            margin: 1.5cm 2cm 1.5cm 2.5cm; /* Atas, Kanan, Bawah, Kiri (margin dokumen resmi) */
            size: A4 portrait;
        }
        
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 11.5pt; /* Ukuran standar Word */
            line-height: 1.15; /* Spasi standar Word 1.15 */
            color: #000;
        }

        /* Kop Surat */
        .kop-surat {
            text-align: center;
            margin-bottom: 15px;
            position: relative;
            border-bottom: 3px solid #000; /* Garis tebal */
            padding-bottom: 8px;
        }
        
        /* Garis tipis di bawah garis tebal kop */
        .kop-surat::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 100%;
            border-bottom: 1px solid #000;
        }

        .logo {
            width: 75px;
            height: auto;
            position: absolute;
            left: 0;
            top: 0;
        }

        .kop-text {
            margin-left: 70px; /* Jarak dari logo */
        }

        .pemerintah {
            font-size: 14pt;
            font-weight: bold;
            text-transform: uppercase;
            margin: 0;
        }

        .desa {
            font-size: 16pt;
            font-weight: bold;
            text-transform: uppercase;
            margin: 2px 0;
        }

        .alamat {
            font-size: 10pt;
            font-style: italic;
            margin: 0;
        }

        /* Judul Surat */
        .judul-surat {
            text-align: center;
            margin: 15px 0;
        }

        .judul-surat h3 {
            text-decoration: underline;
            text-transform: uppercase;
            margin: 0;
            font-size: 12pt;
            font-weight: bold;
        }

        .nomor-surat {
            text-align: center;
            font-size: 11.5pt;
            margin-top: 2px;
        }

        /* Paragraf Default */
        .paragraf {
            text-align: justify;
            margin-bottom: 6px;
        }

        /* Tabel Biodata (Tabulasi) */
        .table-biodata {
            width: 100%;
            margin-left: 0;
            margin-bottom: 8px;
            border-collapse: collapse;
        }
        .table-biodata td {
            vertical-align: top;
            padding: 1px 0; /* Padding sangat tipis agar tidak makan tempat */
        }
        .label-col { width: 170px; }
        .sep-col { width: 15px; text-align: center; }

        /* Tanda Tangan */
        .tanda-tangan {
            float: right;
            width: 280px;
            text-align: center;
            margin-top: 15px;
        }
        .ttd-space {
            height: 60px; /* Ruang untuk tanda tangan */
        }
    </style>
</head>
<body>

    <div class="kop-surat">
        <img src="{{ public_path('images/logokap.png') }}" class="logo" alt="Logo">
        <div class="kop-text">
            <div class="pemerintah">PEMERINTAH KABUPATEN BANDUNG</div>
            <div class="pemerintah">KECAMATAN MARGAHAYU</div>
            <div class="desa">DESA SAYATI</div>
            <div class="alamat">
                Jl. Raya Sayati No. 123, Kec. Margahayu, Kab. Bandung - Jawa Barat<br>
                Email: info@desasayati.go.id | Telp: (022) 1234567
            </div>
        </div>
    </div>

    <div class="judul-surat">
        <h3>SURAT KETERANGAN SERBAGUNA</h3>
        <div class="nomor-surat">Nomor : K.UMUM / {{ str_pad($surat->id, 3, '0', STR_PAD_LEFT) }} / Ds-Syt/{{ array_search(date('m'), ['01'=>'I','02'=>'II','03'=>'III','04'=>'IV','05'=>'V','06'=>'VI','07'=>'VII','08'=>'VIII','09'=>'IX','10'=>'X','11'=>'XI','12'=>'XII']) }}/{{ date('Y') }}</div>
    </div>

    <div class="paragraf">
        Yang bertanda tangan di bawah ini :
    </div>
    
    <table class="table-biodata">
        <tr>
            <td class="label-col">Nama</td>
            <td class="sep-col">:</td>
            <td>NANDAR KUSNANDAR, S.Hut</td>
        </tr>
        <tr>
            <td class="label-col">Jabatan</td>
            <td class="sep-col">:</td>
            <td>Kepala Desa</td>
        </tr>
    </table>

    <div class="paragraf">
        Dengan ini menerangkan bahwa :
    </div>

    <table class="table-biodata">
        <tr>
            <td class="label-col">Nama</td>
            <td class="sep-col">:</td>
            <td><b>{{ strtoupper($surat->user->name) }}</b></td>
        </tr>
        <tr>
            <td class="label-col">NIK/No Pasport</td>
            <td class="sep-col">:</td>
            <td>{{ $surat->user->nik }}</td>
        </tr>
        <tr>
            <td class="label-col">Tempat Tanggal Lahir</td>
            <td class="sep-col">:</td>
            <td>{{ $surat->user->tempat_lahir }}, {{ $surat->user->tanggal_lahir->format('d/m/Y') }}</td>
        </tr>
        <tr>
            <td class="label-col">Jenis Kelamin</td>
            <td class="sep-col">:</td>
            <td>{{ $surat->user->jenis_kelamin }}</td>
        </tr>
        <tr>
            <td class="label-col">Kewarganegaraan</td>
            <td class="sep-col">:</td>
            <td>Indonesia</td>
        </tr>
        <tr>
            <td class="label-col">Agama</td>
            <td class="sep-col">:</td>
            <td>{{ $surat->user->agama }}</td>
        </tr>
        <tr>
            <td class="label-col">Status</td>
            <td class="sep-col">:</td>
            <td>{{ $surat->user->status_perkawinan }}</td>
        </tr>
        <tr>
            <td class="label-col">Pekerjaan</td>
            <td class="sep-col">:</td>
            <td>{{ $surat->user->pekerjaan }}</td>
        </tr>
        <tr>
            <td class="label-col">Alamat</td>
            <td class="sep-col">:</td>
            <td style="text-align: justify;">{{ $surat->user->alamat }}</td>
        </tr>
    </table>

    <div class="paragraf">
        Berdasarkan Pernyataan dan keterangan dari RT/RW setempat benar bahwa yang bersangkutan Penduduk Desa SAYATI Kecamatan MARGAHAYU Kabupaten BANDUNG, Menerangkan Bahwa:
    </div>

    <div class="paragraf" style="text-align: justify;">
        {{ strtoupper($surat->keterangan) }}
    </div>

    <div class="paragraf">
        Keterangan ini dipergunakan untuk : Seperlunya
    </div>

    <div class="paragraf">
        Demikian Surat Keterangan ini dibuat dengan sebanarnya untuk di pergunakan oleh yang bersangkutan sebagaimana mestinya.
    </div>

    <div class="tanda-tangan">
        <div>Sayati, {{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}</div>
        <div>Kepala Desa Sayati</div>
        
        <div class="ttd-space"></div>
        
        <div style="font-weight: bold; text-decoration: underline;">NANDAR KUSNANDAR, S.Hut</div>
    </div>

</body>
</html>