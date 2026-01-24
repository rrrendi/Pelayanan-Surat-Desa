<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $surat->suratJenis->nama_surat }}</title>
    <style>
        @page {
            margin: 2cm;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            line-height: 1.8;
            color: #000;
        }

        .header-wrapper {
            border-bottom: 4px double #000;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }

        .kop-surat {
            text-align: center;
            position: relative;
        }

        .logo {
            position: absolute;
            left: 0;
            top: 0;
            width: 80px;
            height: 80px;
        }

        .kop-content {
            padding-left: 100px;
            padding-right: 100px;
        }

        .kop-surat h2 {
            margin: 0;
            font-size: 20pt;
            text-transform: uppercase;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .kop-surat h3 {
            margin: 3px 0;
            font-size: 16pt;
            font-weight: bold;
        }

        .kop-surat p {
            margin: 2px 0;
            font-size: 11pt;
        }

        .nomor-surat {
            text-align: center;
            margin: 25px 0;
        }

        .nomor-surat h4 {
            text-decoration: underline;
            font-weight: bold;
            font-size: 14pt;
            margin: 5px 0;
            text-transform: uppercase;
        }

        .nomor-surat p {
            margin: 3px 0;
            font-size: 11pt;
        }

        .isi-surat {
            text-align: justify;
            margin: 25px 0;
        }

        .pembuka {
            text-indent: 40px;
            margin-bottom: 15px;
        }

        .data-table {
            margin: 20px 0 20px 40px;
            border-collapse: collapse;
        }

        .data-table td {
            padding: 5px 10px;
            vertical-align: top;
        }

        .data-table td:first-child {
            width: 180px;
            font-weight: 500;
        }

        .data-table td:nth-child(2) {
            width: 20px;
            text-align: center;
        }

        .data-table td:last-child {
            font-weight: bold;
        }

        .keperluan {
            background: #f5f5f5;
            padding: 15px;
            border-left: 4px solid #333;
            margin: 20px 0;
        }

        .keperluan strong {
            display: block;
            margin-bottom: 8px;
            font-size: 11pt;
        }

        .penutup {
            text-indent: 40px;
            margin-top: 20px;
        }

        .ttd-section {
            margin-top: 40px;
        }

        .ttd {
            float: right;
            text-align: center;
            width: 250px;
        }

        .ttd p {
            margin: 5px 0;
        }

        .ttd-space {
            margin: 70px 0;
        }

        .ttd-name {
            font-weight: bold;
            text-decoration: underline;
        }

        .ttd-position {
            font-size: 10pt;
        }

        .footer {
            clear: both;
            margin-top: 80px;
            padding-top: 15px;
            border-top: 1px solid #ccc;
        }

        .footer-note {
            font-size: 9pt;
            font-style: italic;
            color: #666;
        }

        .footer-info {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
            font-size: 9pt;
            color: #666;
        }

        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 80pt;
            color: rgba(0, 0, 0, 0.05);
            z-index: -1;
            font-weight: bold;
        }

        .stamp {
            position: relative;
            margin-top: -40px;
            margin-left: 120px;
        }

        .stamp-circle {
            width: 80px;
            height: 80px;
            border: 3px solid #cc0000;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 8pt;
            font-weight: bold;
            color: #cc0000;
            text-align: center;
        }

        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="watermark">ASLI</div>

    <div class="header-wrapper">
        <div class="kop-surat">
            <div class="logo">
                <!-- Placeholder untuk logo, bisa diganti dengan gambar asli -->
                <svg width="80" height="80" viewBox="0 0 80 80">
                    <circle cx="40" cy="40" r="38" fill="none" stroke="#000" stroke-width="2"/>
                    <text x="40" y="50" font-size="40" text-anchor="middle" font-weight="bold">🏛️</text>
                </svg>
            </div>
            <div class="kop-content">
                <h2>Pemerintah Desa Sayati</h2>
                <h3>Kecamatan Margahayu</h3>
                <p><strong>Kabupaten Bandung - Provinsi Jawa Barat</strong></p>
                <p>Alamat: Jl. Kantor Desa No. 1, Sayati, Margahayu, Bandung 40287</p>
                <p>Telp: (022) 12345678 | Email: info@desasayati.go.id</p>
            </div>
        </div>
    </div>

    <div class="nomor-surat">
        <h4>{{ strtoupper($surat->suratJenis->nama_surat) }}</h4>
        <p>Nomor: {{ str_pad($surat->id, 4, '0', STR_PAD_LEFT) }}/SK-{{ strtoupper(substr($surat->suratJenis->nama_surat, 0, 2)) }}/{{ date('m') }}/{{ date('Y') }}</p>
    </div>

    <div class="isi-surat">
        <p class="pembuka">
            Yang bertanda tangan di bawah ini Kepala Desa Sayati, Kecamatan Margahayu, 
            Kabupaten Bandung, Provinsi Jawa Barat, dengan ini menerangkan bahwa:
        </p>

        <table class="data-table">
            <tr>
                <td>Nama Lengkap</td>
                <td>:</td>
                <td>{{ strtoupper($surat->user->name) }}</td>
            </tr>
            <tr>
                <td>NIK</td>
                <td>:</td>
                <td>{{ $surat->user->nik }}</td>
            </tr>
            <tr>
                <td>Tempat/Tanggal Lahir</td>
                <td>:</td>
                <td>Bandung / 01 Januari 1990</td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>:</td>
                <td>Laki-laki</td>
            </tr>
            <tr>
                <td>Pekerjaan</td>
                <td>:</td>
                <td>Wiraswasta</td>
            </tr>
            <tr>
                <td>Agama</td>
                <td>:</td>
                <td>Islam</td>
            </tr>
            <tr>
                <td>Status Perkawinan</td>
                <td>:</td>
                <td>Kawin</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td>{{ $surat->user->alamat }}</td>
            </tr>
        </table>

        <p class="pembuka">
            Adalah benar warga Desa Sayati yang berdomisili di alamat tersebut di atas 
            dan terdaftar dalam Administrasi Kependudukan Desa Sayati.
        </p>

        <div class="keperluan">
            <strong>Keperluan:</strong>
            {{ $surat->keterangan }}
        </div>

        <p class="penutup">
            Demikian surat keterangan ini dibuat dengan sebenarnya untuk dapat 
            dipergunakan sebagaimana mestinya. Atas perhatian dan kerjasamanya 
            diucapkan terima kasih.
        </p>
    </div>

    <div class="ttd-section">
        <div class="ttd">
            <p>Sayati, {{ \Carbon\Carbon::now()->locale('id')->isoFormat('D MMMM Y') }}</p>
            <p class="ttd-position"><strong>Kepala Desa Sayati</strong></p>
            <div class="ttd-space"></div>
            
            <div class="stamp">
                <div class="stamp-circle">
                    STEMPEL<br>DESA<br>SAYATI
                </div>
            </div>
            
            <p class="ttd-name">Fijia Al Hadiansyah</p>
            <p style="font-size: 10pt;">NIP. 19800101 200501 1 001</p>
        </div>
    </div>

    <div class="footer">
        <div class="footer-note">
            * Surat ini dicetak secara elektronik melalui Sistem Pelayanan Surat Desa dan sah tanpa tanda tangan basah.
        </div>
        <div class="footer-info">
            <div>Dicetak pada: {{ \Carbon\Carbon::now()->format('d/m/Y H:i:s') }} WIB</div>
            <div>Kode Verifikasi: {{ strtoupper(md5($surat->id . $surat->created_at)) }}</div>
        </div>
    </div>
</body>
</html>