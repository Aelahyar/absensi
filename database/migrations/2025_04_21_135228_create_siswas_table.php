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
        Schema::create('siswas', function (Blueprint $table) {
            $table->id('id_siswa');
            $table->string('nis')->unique();
            $table->string('nama_siswa');
            $table->string('tempat_lahir');
            $table->date('tgl_lahir');
            $table->enum('jk', ['Laki-laki', 'Perempuan']);
            $table->string('alamat');
            $table->string('th_angkatan');
            $table->enum('status', ['Y', 'N'])->default('Y');
            $table->string('pndk');
            $table->unsignedBigInteger('id_mkelas');
            $table->timestamps();

            // Foreign key ke tabel mkelas
            $table->foreign('id_mkelas')->references('id_mkelas')->on('kelas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
