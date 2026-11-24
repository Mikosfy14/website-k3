<?php

use App\Models\JalurGambar;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Hapus kolom gambar_jalur_url - sudah tidak dipakai kode manapun
     * sejak data dipindah ke tabel jalur_gambar (lihat migrasi
     * create_jalur_gambar_table). Sudah diverifikasi manual sebelum ini
     * dijalankan: path, urutan, dan file fisik semua cocok.
     */
    public function up(): void
    {
        Schema::table('jalur_mitigasi', function (Blueprint $table) {
            $table->dropColumn('gambar_jalur_url');
        });
    }

    /**
     * Rollback tetap mengembalikan data (bukan cuma kolom kosong) -
     * dibangun ulang dari tabel jalur_gambar supaya migrasi ini aman
     * untuk di-undo kapan saja.
     */
    public function down(): void
    {
        Schema::table('jalur_mitigasi', function (Blueprint $table) {
            $table->string('gambar_jalur_url', 255)->nullable();
        });

        DB::table('jalur_mitigasi')->orderBy('id_jalur')->each(function ($jalur) {
            $paths = JalurGambar::where('id_jalur', $jalur->id_jalur)
                ->orderBy('urutan')
                ->pluck('path')
                ->all();

            DB::table('jalur_mitigasi')
                ->where('id_jalur', $jalur->id_jalur)
                ->update([
                    'gambar_jalur_url' => !empty($paths) ? json_encode($paths) : null,
                ]);
        });
    }
};
