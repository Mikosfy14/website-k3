<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ruangan;
use App\Models\Lantai;

class RuanganSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus semua data ruangan lama
        Ruangan::truncate();

        // Ambil semua lantai (dengan nama kolom yang benar)
        $lantai = [
            1 => Lantai::where('nama_lantai', 'Lantai 1')->firstOrFail(),
            2 => Lantai::where('nama_lantai', 'Lantai 2')->firstOrFail(),
            3 => Lantai::where('nama_lantai', 'Lantai 3')->firstOrFail(),
            4 => Lantai::where('nama_lantai', 'Lantai 4')->firstOrFail(),
            5 => Lantai::where('nama_lantai', 'Lantai 5')->firstOrFail(),
            6 => Lantai::where('nama_lantai', 'Lantai 6')->firstOrFail(),
            7 => Lantai::where('nama_lantai', 'Lantai 7')->firstOrFail(),
            8 => Lantai::where('nama_lantai', 'Lantai 8')->firstOrFail(),
        ];

        // === LANTAI 1 ===
        $this->createBatch($lantai[1], [
            ['Ruang Pelayanan Kelas Pangan dan Bisnis Halal',        'RPK-PBH'],
            ['Laboratorium Riset Inovasi Pangan dan Bisnis Halal',   'LAB-RIPBH'],
            ['Ruang Workshop Desain',                                'RWD'],
        ]);

        // === LANTAI 2 ===
        $this->createBatch($lantai[2], [
            ['Vocafe',                                               'VOCAFE'],
            ['Laboratorium Kamar Hotel Deluxe 1',                    'LAB-HOTEL-DX1'],
            ['Laboratorium Kamar Hotel Deluxe 2',                    'LAB-HOTEL-DX2'],
            ['Laboratorium Kamar Hotel Standar',                     'LAB-HOTEL-STD'],
            ['Ruang Dosen Program Studi D-IV Manajemen Perhotelan',  'DOSEN-MP'],
            ['Mushola',                                              'MUSHOLA'],
            ['Ruang Kelas A201',                                     'A201'],
        ]);

        // === LANTAI 3 ===
        $this->createBatch($lantai[3], [
            ['Ruang Dekan dan Wakil Dekan',                          'DEKANAT'],
            ['Executive Meeting Room',                               'EMR'],
            ['Ruang Podcast',                                        'PODCAST'],
            ['Ruang Administrasi',                                   'ADMIN'],
            ['Ruang PSIK',                                           'PSIK'],
            ['Ruang Kelas A302',                                     'A302'],
            ['Ruang Kelas A303',                                     'A303'],
            ['Ruang Kelas A304',                                     'A304'],
        ]);

        // === LANTAI 4 ===
        $this->createBatch($lantai[4], [
            ['Ruang Dosen Program Studi D-III Teknologi Informasi',  'DOSEN-TI'],
            ['Laboratorium Komputer 401',                            'LAB-KOM-401'],
            ['Laboratorium Internet of Thing & Human Centered Design 402', 'LAB-IOT-HCD-402'],
            ['Laboratorium Internet of Thing & Human Centered Design 403', 'LAB-IOT-HCD-403'],
            ['Ruang Kuliah A404',                                    'A404'],
        ]);

        // === LANTAI 5 ===
        $this->createBatch($lantai[5], [
            ['Ruang Transit Dosen',                                  'TRANSIT-DOSEN'],
            ['Ruang Kelas A501',                                     'A501'],
            ['Ruang Kelas A502',                                     'A502'],
            ['Ruang Kelas A503',                                     'A503'],
            ['Ruang Kelas A504',                                     'A504'],
        ]);

        // === LANTAI 6 ===
        $this->createBatch($lantai[6], [
            ['Ruang Dosen Program Studi D-IV Desain Grafis',         'DOSEN-DG'],
            ['Laboratorium Animasi dan Multimedia 601',              'LAB-ANIMASI-601'],
            ['Laboratorium Gambar 602',                              'LAB-GAMBAR-602'],
            ['Laboratorium Teaching Factory 603',                    'LAB-TF-603'],
            ['Laboratorium Produksi',                                'LAB-PRODUKSI'],
            ['Laboratorium Fotografi Videografi 605',                'LAB-FOTOVIDEO-605'],
        ]);

        // === LANTAI 7 ===
        $this->createBatch($lantai[7], [
            ['Ruang Kuliah A701',                                    'A701'],
            ['Ruang Kuliah A702',                                    'A702'],
            ['Ruang Kuliah A703',                                    'A703'],
            ['Ruang Kuliah A704',                                    'A704'],
            ['Ruang Kuliah A705',                                    'A705'],
        ]);

        // === LANTAI 8 ===
        $this->createBatch($lantai[8], [
            ['Co-Working Space I',                                   'COWORK-1'],
            ['Co-Working Space II',                                  'COWORK-2'],
        ]);

        $this->command->info('Ruangan berhasil diseed! Total: ' . Ruangan::count() . ' ruangan');
    }

    private function createBatch($lantai, array $ruanganList)
    {
        foreach ($ruanganList as $item) {
            Ruangan::create([
                'id_lantai'     => $lantai->id_lantai,  // Sesuai dengan struktur database
                'nama_ruangan'  => $item[0],
                'kode_ruangan'  => $item[1],
            ]);
        }
    }
}
