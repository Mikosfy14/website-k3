<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lantai;
use App\Models\Ruangan;

class EvakuasiController extends Controller
{
    public function index()
    {
        $lantais = Lantai::all();  // Opsional: Dropdown lantai
        return view('evakuasi.index', compact('lantais'));
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
            $ruangan = Ruangan::where('nama_ruangan', 'like', "%$ruanganInput%")
                ->orWhere('kode_ruangan', 'like', "%$ruanganInput%")
                ->first();

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
