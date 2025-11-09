<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lantai;
use App\Models\Gedung;
use App\Models\JalurMitigasi;

class LantaiSeeder extends Seeder
{
    public function run(): void
    {
        $gedung = Gedung::first();  // mengambil gedung pertama
        $jalurUtama = JalurMitigasi::first();  // mengambil jalur pertama
        $jalurAlternatif = JalurMitigasi::skip(1)->first();  // mengambil jalur kedua

        Lantai::create([
            'id_gedung' => $gedung->id_gedung,
            'id_jalur' => $jalurUtama->id_jalur,
            'nama_lantai' => 'Lantai 1',
        ]);

        Lantai::create([
            'id_gedung' => $gedung->id_gedung,
            'id_jalur' => $jalurAlternatif->id_jalur,
            'nama_lantai' => 'Lantai 2',
        ]);
    }
}
