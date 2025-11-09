<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JalurMitigasi;

class JalurMitigasiController extends Controller
{
    public function index()
    {
        $jalurs = JalurMitigasi::all();
        return view('admin.jalur-mitigasi.index', compact('jalurs'));
    }

    public function create()
    {
        return view('admin.jalur-mitigasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jalur' => 'required|string|max:255',
            'deskripsi_teks' => 'required|string',
            'gambar_jalur_url' => 'nullable|url|max:255',
            'assembly_point' => 'required|string|max:100',
        ]);

        JalurMitigasi::create($request->all());
        return redirect()->route('jalur-mitigasi.index')->with('success', 'Jalur mitigasi berhasil ditambahkan.');
    }

    public function show($id)
    {
        $jalur = JalurMitigasi::findOrFail($id);
        return view('admin.jalur-mitigasi.show', compact('jalur'));
    }

    public function edit($id)
    {
        $jalur = JalurMitigasi::findOrFail($id);
        return view('admin.jalur-mitigasi.edit', compact('jalur'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_jalur' => 'required|string|max:255',
            'deskripsi_teks' => 'required|string',
            'gambar_jalur_url' => 'nullable|url|max:255',
            'assembly_point' => 'required|string|max:100',
        ]);

        $jalur = JalurMitigasi::findOrFail($id);
        $jalur->update($request->all());
        return redirect()->route('jalur-mitigasi.index')->with('success', 'Jalur mitigasi berhasil diupdate.');
    }

    public function destroy($id)
    {
        $jalur = JalurMitigasi::findOrFail($id);
        $jalur->delete();
        return redirect()->route('jalur-mitigasi.index')->with('success', 'Jalur mitigasi berhasil dihapus.');
    }
}
