<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gedung;

class GedungSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Gedung::create([
            'nama_gedung' => 'Fakultas Vokasi Universitas Brawijaya Kampus 2 Dieng',
            'alamat_gedung' => 'Jl. Puncak Dieng, Kunci, Kalisongo, Dau, Malang, Jawa Timur 65151',
            'deskripsi_singkat' => 'Gedung utama fakultas vokasi universitas brawijaya yang terletak di kampus 2 dieng.'
        ]);
    }
}
