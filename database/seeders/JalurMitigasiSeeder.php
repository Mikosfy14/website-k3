<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JalurMitigasi;

class JalurMitigasiSeeder extends Seeder
{
    public function run(): void
    {
        // Catatan: gambar tidak diisi dari seeder (lihat app/Models/JalurGambar.php).
        // Upload gambar nyata lewat halaman admin, bukan lewat seeder.
        JalurMitigasi::create([
            'nama_jalur' => 'Jalur Evakuasi Tangga Utama',
            'deskripsi_teks' => 'Turun tangga utama di depan lift, dan hindari menggunakan lift.',
            'assembly_point' => 'Lobby utama gedung',
        ]);

        JalurMitigasi::create([
            'nama_jalur' => 'Jalur Evakuasi Tangga Darurat Alternatif',
            'deskripsi_teks' => 'Akses pintu darurat bewarna biru yang mengarah ke tangga darurat',
            'assembly_point' => 'Parkir Belakang Gedung',
        ]);
    }
}
