<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ruangan;
use App\Models\Lantai;

class RuanganController extends Controller
{
    public function index(Request $request)
    {
        $query = Ruangan::with('lantai.gedung');

        // Search berdasarkan nama ruangan
        if ($request->has('search') && !empty($request->search)) {
            $query->where('nama_ruangan', 'like', '%' . $request->search . '%');
        }

        // Filter berdasarkan lantai
        if ($request->has('lantai') && !empty($request->lantai)) {
            $query->where('id_lantai', $request->lantai);
        }

        $ruangans = $query->paginate(5);
        $lantais = Lantai::with('gedung')->get();

        return view('admin.ruangan.index', compact('ruangans', 'lantais'));
    }

    public function create()
    {
        $lantais = Lantai::all();
        return view('admin.ruangan.create', compact('lantais'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_lantai' => 'required|exists:lantai,id_lantai',
            'nama_ruangan' => 'required|string|max:100',
            'kode_ruangan' => 'required|string|max:20',
        ]);

        Ruangan::create($request->all());
        return redirect()->route('admin.ruangan.index')->with('success', 'Ruangan berhasil ditambahkan.');
    }

    public function show($id)
    {
        $ruangan = Ruangan::with('lantai.gedung')->findOrFail($id);
        return view('admin.ruangan.show', compact('ruangan'));
    }

    public function edit($id)
    {
        $ruangan = Ruangan::findOrFail($id);
        $lantais = Lantai::all();
        return view('admin.ruangan.edit', compact('ruangan', 'lantais'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_lantai' => 'required|exists:lantai,id_lantai',
            'nama_ruangan' => 'required|string|max:100',
            'kode_ruangan' => 'required|string|max:20',
        ]);

        $ruangan = Ruangan::findOrFail($id);
        $ruangan->update($request->all());
        return redirect()->route('admin.ruangan.index')->with('success', 'Ruangan berhasil diupdate.');
    }

    public function destroy($id)
    {
        $ruangan = Ruangan::findOrFail($id);
        $ruangan->delete();
        return redirect()->route('admin.ruangan.index')->with('success', 'Ruangan berhasil dihapus.');
    }
}
