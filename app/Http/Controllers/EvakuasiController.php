<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lantai;
use App\Models\Ruangan;

class EvakuasiController extends Controller
{
    public function index()
    {
        $lantais = Lantai::with('gedung')->get();

        // Preload data ruangan untuk setiap lantai
        $ruanganData = [];
        foreach ($lantais as $lantai) {
            $ruanganData[$lantai->nama_lantai] = Ruangan::where('id_lantai', $lantai->id_lantai)
                ->select('nama_ruangan', 'kode_ruangan')
                ->get()
                ->toArray();
        }

        // Convert to JSON for JavaScript
        $ruanganDataJson = json_encode($ruanganData);

        return view('evakuasi.index', compact('lantais', 'ruanganDataJson'));
    }

    public function cari(Request $request)
    {
        $request->validate([
            'lantai' => 'required|string',
            'ruangan' => 'nullable|string',
        ]);

        $lantaiInput = $request->lantai;
        $ruanganInput = $request->ruangan;

        // Cari berdasarkan ruangan kalau diisi
        if ($ruanganInput) {
            $ruangan = Ruangan::where('nama_ruangan', $ruanganInput)->first();

            if ($ruangan) {
                $lantai = $ruangan->lantai;
            } else {
                return redirect()->back()->with('error', 'Ruangan tidak ditemukan.');
            }
        } else {
            // Cari langsung lantai
            $lantai = Lantai::where('nama_lantai', $lantaiInput)->first();
        }

        if (!$lantai) {
            return redirect()->back()->with('error', 'Lantai tidak ditemukan.');
        }

        $jalur = $lantai->jalurMitigasi;

        return view('evakuasi.hasil', compact('lantai', 'jalur', 'ruanganInput'));
    }
}
