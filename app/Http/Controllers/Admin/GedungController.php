<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gedung;

class GedungController extends Controller
{
    public function index()
    {
        $gedungs = Gedung::all();
        return view('admin.gedung.index', compact('gedungs'));
    }

    public function create()
    {
        return view('admin.gedung.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_gedung' => 'required|string|max:100',
            'alamat_gedung' => 'required|string',
            'deskripsi_singkat' => 'required|string',
        ]);

        Gedung::create($request->all());
        return redirect()->route('admin.gedung.index')->with('success', 'Gedung berhasil ditambahkan.');
    }

    public function show($id)
    {
        $gedung = Gedung::findOrFail($id);
        return view('admin.gedung.show', compact('gedung'));
    }

    public function edit($id)
    {
        $gedung = Gedung::findOrFail($id);
        return view('admin.gedung.edit', compact('gedung'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_gedung' => 'required|string|max:100',
            'alamat_gedung' => 'required|string',
            'deskripsi_singkat' => 'required|string',
        ]);

        $gedung = Gedung::findOrFail($id);
        $gedung->update($request->all());
        return redirect()->route('admin.gedung.index')->with('success', 'Gedung berhasil diupdate.');
    }

    public function destroy($id)
    {
        $gedung = Gedung::findOrFail($id);
        $gedung->delete();
        return redirect()->route('admin.gedung.index')->with('success', 'Gedung berhasil dihapus.');
    }
}
