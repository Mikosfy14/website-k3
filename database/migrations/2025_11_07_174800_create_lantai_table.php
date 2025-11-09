<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lantai', function (Blueprint $table) {
            $table->id('id_lantai');  // primary custom
            $table->foreignId('id_gedung')->constrained('gedung', 'id_gedung')->onDelete('cascade');  // tambah 'id_gedung' di constrained
            $table->foreignId('id_jalur')->constrained('jalur_mitigasi', 'id_jalur')->onDelete('cascade');  // tambah 'id_jalur'
            $table->string('nama_lantai', 50);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lantai');
    }
};
