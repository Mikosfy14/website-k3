<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JalurMitigasi;

class JalurMitigasiSeeder extends Seeder
{
    public function run(): void
    {
        JalurMitigasi::create([
            'nama_jalur' => 'Jalur Evakuasi Tangga Utama',
            'deskripsi_teks' => 'Turun tangga utama di depan lift, dan hindari menggunakan lift.',
            'gambar_jalur_url' => 'https://example.com/gambar-jalur-utama.jpg',
            'assembly_point' => 'Lobby utama gedung',
        ]);

        JalurMitigasi::create([
            'nama_jalur' => 'Jalur Evakuasi Tangga Darurat Alternatif',
            'deskripsi_teks' => 'Akses pintu darurat bewarna biru yang mengarah ke tangga darurat',
            'gambar_jalur_url' => 'https://example.com/gambar-jalur-alternatif.jpg',
            'assembly_point' => 'Parkir Belakang Gedung',
        ]);
    }
}
