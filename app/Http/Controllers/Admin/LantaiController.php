<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lantai;
use App\Models\Gedung;
use App\Models\JalurMitigasi;

class LantaiController extends Controller
{
    public function index()
    {
        $lantais = Lantai::with(['gedung', 'jalurMitigasi'])->get();
        return view('admin.lantai.index', compact('lantais'));
    }

    public function create()
    {
        $gedungs = Gedung::all();
        $jalurs = JalurMitigasi::all();
        return view('admin.lantai.create', compact('gedungs', 'jalurs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_gedung' => 'required|exists:gedung,id_gedung',
            'id_jalur' => 'required|exists:jalur_mitigasi,id_jalur',
            'nama_lantai' => 'required|string|max:50',
        ]);

        Lantai::create($request->all());
        return redirect()->route('lantai.index')->with('success', 'Lantai berhasil ditambahkan.');
    }

    public function show($id)
    {
        $lantai = Lantai::with(['gedung', 'jalurMitigasi'])->findOrFail($id);
        return view('admin.lantai.show', compact('lantai'));
    }

    public function edit($id)
    {
        $lantai = Lantai::findOrFail($id);
        $gedungs = Gedung::all();
        $jalurs = JalurMitigasi::all();
        return view('admin.lantai.edit', compact('lantai', 'gedungs', 'jalurs'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_gedung' => 'required|exists:gedung,id_gedung',
            'id_jalur' => 'required|exists:jalur_mitigasi,id_jalur',
            'nama_lantai' => 'required|string|max:50',
        ]);

        $lantai = Lantai::findOrFail($id);
        $lantai->update($request->all());
        return redirect()->route('lantai.index')->with('success', 'Lantai berhasil diupdate.');
    }

    public function destroy($id)
    {
        $lantai = Lantai::findOrFail($id);
        $lantai->delete();
        return redirect()->route('lantai.index')->with('success', 'Lantai berhasil dihapus.');
    }
}
