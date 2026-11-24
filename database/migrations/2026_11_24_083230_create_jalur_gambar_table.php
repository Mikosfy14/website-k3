<?php

use App\Models\JalurMitigasi;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Pindahkan gambar jalur dari kolom jalur_mitigasi.gambar_jalur_url
     * (JSON string di kolom varchar(255), rawan terpotong) ke tabel
     * terpisah dengan satu baris per gambar.
     *
     * Kolom lama TIDAK dihapus di sini (lihat down()/migrasi terpisah
     * nanti) supaya masih bisa rollback kalau migrasi data gagal.
     */
    public function up(): void
    {
        Schema::create('jalur_gambar', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_jalur');
            $table->string('path', 255);
            $table->unsignedInteger('urutan')->default(0);
            $table->timestamps();

            $table->foreign('id_jalur')
                ->references('id_jalur')->on('jalur_mitigasi')
                ->onDelete('cascade');
        });

        // Migrasi data lama: decode JSON di gambar_jalur_url, insert satu
        // baris per path gambar, pertahankan urutannya.
        JalurMitigasi::query()
            ->whereNotNull('gambar_jalur_url')
            ->each(function (JalurMitigasi $jalur) {
                $paths = json_decode($jalur->gambar_jalur_url, true);

                if (!is_array($paths)) {
                    return;
                }

                foreach (array_values($paths) as $urutan => $path) {
                    if (!is_string($path) || $path === '') {
                        continue;
                    }

                    \DB::table('jalur_gambar')->insert([
                        'id_jalur' => $jalur->id_jalur,
                        'path' => $path,
                        'urutan' => $urutan,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            });
    }

    public function down(): void
    {
        Schema::dropIfExists('jalur_gambar');
    }
};
