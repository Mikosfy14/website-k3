<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ruangan', function (Blueprint $table) {
            $table->id('id_ruangan');  // primary custom
            $table->foreignId('id_lantai')->constrained('lantai', 'id_lantai')->onDelete('cascade');  // tambah 'id_lantai'
            $table->string('nama_ruangan', 100);
            $table->string('kode_ruangan', 20);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ruangan');
    }
};
