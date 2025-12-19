<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gedung;

class GedungController extends Controller
{
    public function index(Request $request)
    {
        $query = Gedung::query();

        // Search berdasarkan nama gedung atau alamat
        if ($request->has('search') && !empty($request->search)) {
            $query->where(function ($q) use ($request) {
                $q->where('nama_gedung', 'like', '%' . $request->search . '%')
                    ->orWhere('alamat_gedung', 'like', '%' . $request->search . '%');
            });
        }

        $gedungs = $query->paginate(5)->withQueryString();

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
