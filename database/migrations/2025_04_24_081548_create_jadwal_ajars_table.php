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
        Schema::create('jadwal_ajars', function (Blueprint $table) {
            $table->id('id_mengajar');
            $table->string('kode_pelajaran');
            $table->string('hari');
            $table->string('jam_mengajar');
            $table->string('jamke');
            $table->string('id_guru');
            $table->string('id_mapel');
            $table->string('id_kelas');
            $table->string('id_semester');
            $table->string('id_thajaran');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_ajars');
    }
};
