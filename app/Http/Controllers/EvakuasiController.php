<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lantai;
use App\Models\Ruangan;

class EvakuasiController extends Controller
{
    public function index()
    {
        // Eager load ruangans supaya tidak query per-lantai di loop (N+1).
        $lantais = Lantai::with([
            'gedung',
            'ruangans' => function ($query) {
                $query->select('id_ruangan', 'id_lantai', 'nama_ruangan', 'kode_ruangan');
            },
        ])->get();

        // Preload data ruangan untuk setiap lantai dari relasi yang sudah di-load
        $ruanganData = [];
        foreach ($lantais as $lantai) {
            $ruanganData[$lantai->nama_lantai] = $lantai->ruangans
                ->map(fn ($r) => ['nama_ruangan' => $r->nama_ruangan, 'kode_ruangan' => $r->kode_ruangan])
                ->toArray();
        }

        // Convert to JSON for JavaScript.
        // Flag JSON_HEX_* mencegah data (misal nama ruangan berisi "</script>")
        // memecah tag <script> saat dicetak mentah lewat {!! !!} di view.
        $ruanganDataJson = json_encode(
            $ruanganData,
            JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP
        );

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
