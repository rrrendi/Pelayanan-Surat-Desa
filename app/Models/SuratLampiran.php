<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratLampiran extends Model
{
    use HasFactory;
    
    // Tentukan nama tabel secara eksplisit agar aman
    protected $table = 'surat_lampiran';

    protected $fillable = ['pengajuan_surat_id', 'file_path', 'nama_file'];

    public function pengajuanSurat()
    {
        return $this->belongsTo(PengajuanSurat::class);
    }
}