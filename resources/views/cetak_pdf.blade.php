<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>{{ $surat->suratJenis->nama_surat }}</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            line-height: 1.6;
            margin: 40px;
        }

        .kop-surat {
            text-align: center;
            border-bottom: 3px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .kop-surat h2 {
            margin: 0;
            font-size: 18pt;
            text-transform: uppercase;
        }

        .kop-surat p {
            margin: 2px 0;
            font-size: 11pt;
        }

        .nomor-surat {
            text-align: center;
            margin: 20px 0;
            text-decoration: underline;
            font-weight: bold;
            font-size: 14pt;
        }

        .isi-surat {
            text-align: justify;
            margin: 20px 0;
        }

        .data-pemohon {
            margin-left: 40px;
        }

        .ttd {
            margin-top: 40px;
            float: right;
            text-align: center;
            width: 250px;
        }

        .ttd-space {
            margin: 60px 0;
        }

        .footer {
            clear: both;
            margin-top: 100px;
            font-size: 10pt;
            font-style: italic;
        }
    </style>
</head>

<body>
    <div class="kop-surat">
        <h2>Pemerintah Desa Sayati</h2>
        <p>Kecamatan Margahayu, Kabupaten Bandung</p>
        <p>Alamat: Jl. Kantor Desa No. 1, Telp. (021) 12345678</p>
    </div>

    <div class="nomor-surat">
        {{ strtoupper($surat->suratJenis->nama_surat) }}<br>
        Nomor: {{ str_pad($surat->id, 3, '0', STR_PAD_LEFT) }}/SK/{{ date('Y') }}
    </div>

    <div class="isi-surat">
        <p>Yang bertanda tangan di bawah ini Kepala Desa Sayati, Kecamatan Margahayu, Kabupaten Bandung, menerangkan bahwa:</p>

        <div class="data-pemohon">
            <table>
                <tr>
                    <td width="150">Nama</td>
                    <td width="20">:</td>
                    <td><strong>{{ $surat->user->name }}</strong></td>
                </tr>
                <tr>
                    <td>NIK</td>
                    <td>:</td>
                    <td>{{ $surat->user->nik }}</td>
                </tr>
                <tr>
                    <td>Alamat
                    </td>
                    <td>:</td>
                    <td>{{ $surat->user->alamat }}</td>
                </tr>
            </table>
        </div>
        <p style="margin-top: 20px;">
            Adalah benar warga Desa Sayati yang mengajukan permohonan {{ $surat->suratJenis->nama_surat }}
            dengan keperluan: <strong>{{ $surat->keterangan }}</strong>
        </p>

        <p>
            Demikian surat keterangan ini dibuat untuk dapat dipergunakan sebagaimana mestinya.
        </p>
    </div>

    <div class="ttd">
        <p>Sayati, {{ \Carbon\Carbon::now()->locale('id')->isoFormat('D MMMM Y') }}</p>
        <p><strong>Kepala Desa</strong></p>
        <div class="ttd-space"></div>
        <p><strong><u>Fijia Al Hadiansyah</u></strong></p>
    </div>

    <div class="footer">
        Dicetak pada: {{ \Carbon\Carbon::now()->format('d/m/Y H:i:s') }}
    </div>
</body>
</html>