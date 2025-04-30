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
        Schema::create('log_presensis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_mengajar');
            $table->string('status'); // hadir, izin, alpha
            $table->date('tanggal');
            $table->timestamps();

            $table->foreign('id_mengajar')->references('id_mengajar')->on('jadwal_ajars')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_presensis');
    }
};
