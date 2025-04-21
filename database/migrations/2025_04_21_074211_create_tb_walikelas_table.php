<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('tb_walikelas', function (Blueprint $table) {
            $table->id('id_walikelas');
            $table->unsignedBigInteger('id_guru');
            $table->unsignedBigInteger('id_mkelas');
            $table->timestamps();

            $table->foreign('id_guru')->references('id_guru')->on('guru')->onDelete('cascade');
            $table->foreign('id_mkelas')->references('id_mkelas')->on('kelas')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_walikelas');
    }
};
