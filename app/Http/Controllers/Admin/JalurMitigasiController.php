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
            'gambar_jalur_url' => 'nullable|array',
            'gambar_jalur_url.*' => 'nullable|url|max:255',
            'assembly_point' => 'required|string|max:100',
        ]);

        $data = $request->only(['nama_jalur', 'deskripsi_teks', 'assembly_point']);

        // Convert array of URLs to JSON string
        if ($request->has('gambar_jalur_url')) {
            $urls = array_filter($request->gambar_jalur_url); // Remove empty values
            $data['gambar_jalur_url'] = !empty($urls) ? json_encode(array_values($urls)) : null;
        }

        JalurMitigasi::create($data);
        return redirect()->route('admin.jalur-mitigasi.index')->with('success', 'Jalur mitigasi berhasil ditambahkan.');
    }

    public function show($id)
    {
        $jalur = JalurMitigasi::findOrFail($id);

        // Decode JSON URLs
        if ($jalur->gambar_jalur_url) {
            $jalur->gambar_urls = json_decode($jalur->gambar_jalur_url, true);
        } else {
            $jalur->gambar_urls = [];
        }

        return view('admin.jalur-mitigasi.show', compact('jalur'));
    }

    public function edit($id)
    {
        $jalur = JalurMitigasi::findOrFail($id);

        // Decode JSON URLs for editing
        if ($jalur->gambar_jalur_url) {
            $jalur->gambar_urls = json_decode($jalur->gambar_jalur_url, true);
        } else {
            $jalur->gambar_urls = [];
        }

        return view('admin.jalur-mitigasi.edit', compact('jalur'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_jalur' => 'required|string|max:255',
            'deskripsi_teks' => 'required|string',
            'gambar_jalur_url' => 'nullable|array',
            'gambar_jalur_url.*' => 'nullable|url|max:255',
            'assembly_point' => 'required|string|max:100',
        ]);

        $jalur = JalurMitigasi::findOrFail($id);

        $data = $request->only(['nama_jalur', 'deskripsi_teks', 'assembly_point']);

        // Convert array of URLs to JSON string
        if ($request->has('gambar_jalur_url')) {
            $urls = array_filter($request->gambar_jalur_url); // Remove empty values
            $data['gambar_jalur_url'] = !empty($urls) ? json_encode(array_values($urls)) : null;
        }

        $jalur->update($data);
        return redirect()->route('admin.jalur-mitigasi.index')->with('success', 'Jalur mitigasi berhasil diupdate.');
    }

    public function destroy($id)
    {
        $jalur = JalurMitigasi::findOrFail($id);
        $jalur->delete();
        return redirect()->route('admin.jalur-mitigasi.index')->with('success', 'Jalur mitigasi berhasil dihapus.');
    }
}
