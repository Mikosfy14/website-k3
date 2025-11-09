<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ruangan;
use App\Models\Lantai;

class RuanganSeeder extends Seeder
{
    public function run(): void
    {
        $lantai1 = Lantai::where('nama_lantai', 'Lantai 1')->first();
        $lantai2 = Lantai::where('nama_lantai', 'Lantai 2')->first();

        Ruangan::create([
            'id_lantai' => $lantai1->id_lantai,
            'nama_ruangan' => 'Ruang Meeting A',
            'kode_ruangan' => 'RMA-501',
        ]);

        Ruangan::create([
            'id_lantai' => $lantai1->id_lantai,
            'nama_ruangan' => 'Ruang Kerja B',
            'kode_ruangan' => 'RKB-502',
        ]);

        Ruangan::create([
            'id_lantai' => $lantai2->id_lantai,
            'nama_ruangan' => 'Ruang Lab C',
            'kode_ruangan' => 'RLC-601',
        ]);
    }
}
