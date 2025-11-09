<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jalur_mitigasi', function (Blueprint $table) {
            $table->id('id_jalur');  // primary custom
            $table->string('nama_jalur', 255);
            $table->text('deskripsi_teks');
            $table->string('gambar_jalur_url', 255)->nullable();
            $table->string('assembly_point', 100);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jalur_mitigasi');
    }
};
