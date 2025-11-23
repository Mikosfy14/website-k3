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
        // Hapus data lama
        Lantai::truncate();

        $gedung = Gedung::first();  // mengambil gedung pertama
        $jalurUtama = JalurMitigasi::first();  // mengambil jalur pertama

        // Data lantai sesuai kebutuhan
        $lantaiData = [
            ['Lantai 1', $gedung->id_gedung, $jalurUtama->id_jalur],
            ['Lantai 2', $gedung->id_gedung, $jalurUtama->id_jalur],
            ['Lantai 3', $gedung->id_gedung, $jalurUtama->id_jalur],
            ['Lantai 4', $gedung->id_gedung, $jalurUtama->id_jalur],
            ['Lantai 5', $gedung->id_gedung, $jalurUtama->id_jalur],
            ['Lantai 6', $gedung->id_gedung, $jalurUtama->id_jalur],
            ['Lantai 7', $gedung->id_gedung, $jalurUtama->id_jalur],
            ['Lantai 8', $gedung->id_gedung, $jalurUtama->id_jalur],
        ];

        foreach ($lantaiData as $data) {
            Lantai::create([
                'nama_lantai' => $data[0],
                'id_gedung' => $data[1],
                'id_jalur' => $data[2],
            ]);
        }
    }
}
