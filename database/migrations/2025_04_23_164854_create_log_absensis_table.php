<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('log_absensis', function (Blueprint $table) {
            $table->id(); // Kolom ID
            $table->unsignedBigInteger('id_siswa'); // Kolom untuk relasi ke siswa
            $table->date('tgl_absen'); // Tanggal absensi
            $table->enum('keterangan', ['H', 'I', 'S', 'A']); // Keterangan absensi: Hadir, Izin, Sakit, Alpa
            $table->timestamps(); // Kolom created_at dan updated_at

            // Membuat foreign key yang menghubungkan log_absensi ke siswa
            $table->foreign('id_siswa')->references('id_siswa')->on('siswas')->onDelete('cascade');
            $table->unique(['id_siswa', 'tgl_absen']); // Pastikan setiap siswa hanya absen 1x per hari
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_absensis');
    }
};
