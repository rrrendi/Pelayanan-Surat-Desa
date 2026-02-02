<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('surat_lampiran', function (Blueprint $table) {
            $table->id();
            // Terhubung ke tabel pengajuan_surat
            $table->foreignId('pengajuan_surat_id')->constrained('pengajuan_surat')->onDelete('cascade');
            $table->string('file_path'); // Lokasi file di storage
            $table->string('nama_file'); // Nama asli file (untuk display)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_lampirans');
    }
};
