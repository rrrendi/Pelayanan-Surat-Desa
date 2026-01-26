<?php
// app/Models/User.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'nik',
        'alamat',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'pekerjaan',
        'status_perkawinan',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'tanggal_lahir' => 'date',
        ];
    }

    public function pengajuanSurat()
    {
        return $this->hasMany(PengajuanSurat::class);
    }

    /**
     * Validasi NIK harus 16 digit
     */
    public static function boot()
    {
        parent::boot();

        static::saving(function ($user) {
            // Validasi NIK sebelum menyimpan
            if ($user->nik) {
                // Pastikan NIK adalah angka
                if (!preg_match('/^[0-9]+$/', $user->nik)) {
                    throw new \Exception('NIK harus berisi angka saja.');
                }
                
                // Pastikan NIK tepat 16 digit
                if (strlen($user->nik) !== 16) {
                    throw new \Exception('NIK harus tepat 16 digit.');
                }
            }
        });
    }

    /**
     * Cek apakah NIK sudah digunakan
     */
    public static function isNikExists($nik, $exceptUserId = null)
    {
        $query = static::where('nik', $nik);
        
        if ($exceptUserId) {
            $query->where('id', '!=', $exceptUserId);
        }
        
        return $query->exists();
    }

    /**
     * Format NIK dengan pemisah untuk tampilan
     */
    public function getFormattedNikAttribute()
    {
        if (!$this->nik) {
            return '-';
        }
        
        // Format: XXXX-XXXX-XXXX-XXXX
        return chunk_split($this->nik, 4, '-');
    }

    /**
     * Get formatted tempat tanggal lahir
     */
    public function getTempatTanggalLahirAttribute()
    {
        if (!$this->tempat_lahir || !$this->tanggal_lahir) {
            return '-';
        }
        
        return $this->tempat_lahir . ', ' . $this->tanggal_lahir->format('d F Y');
    }

    /**
     * Cek apakah user adalah admin
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Cek apakah user adalah warga
     */
    public function isWarga()
    {
        return $this->role === 'warga';
    }

    /**
     * Get initial untuk avatar
     */
    public function getInitialAttribute()
    {
        return strtoupper(substr($this->name, 0, 1));
    }
}