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
        Schema::create('mengajars', function (Blueprint $table) {
            $table->id('id_mengajar');
            $table->string('kode');
            $table->string('hari');
            $table->string('waktu');
            $table->string('jamke');
            $table->unsignedBigInteger('id_guru');
            $table->unsignedBigInteger('id_mapel');
            $table->unsignedBigInteger('id_mkelas');
            $table->unsignedBigInteger('id_semester');
            $table->unsignedBigInteger('id_thajaran');
            $table->timestamps();

            // Foreign keys
            $table->foreign('id_guru')->references('id_guru')->on('guru')->onDelete('cascade');
            $table->foreign('id_mapel')->references('id_mapel')->on('mapels')->onDelete('cascade');
            $table->foreign('id_mkelas')->references('id_mkelas')->on('kelas')->onDelete('cascade');
            $table->foreign('id_semester')->references('id_semester')->on('semesters')->onDelete('cascade');
            $table->foreign('id_thajaran')->references('id_thajaran')->on('tahun_ajarans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mengajars');
    }
};
