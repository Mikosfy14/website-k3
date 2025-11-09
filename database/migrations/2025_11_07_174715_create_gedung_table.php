<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gedung', function (Blueprint $table) {
            $table->id('id_gedung');  // primary key custom
            $table->string('nama_gedung', 100);
            $table->text('alamat_gedung');
            $table->text('deskripsi_singkat');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gedung');
    }
};
