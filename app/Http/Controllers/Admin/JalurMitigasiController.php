<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JalurMitigasi;
use Illuminate\Support\Facades\Storage;

class JalurMitigasiController extends Controller
{
    public function index(Request $request)
    {
        $query = JalurMitigasi::query();

        // Search berdasarkan nama jalur
        if ($request->has('search') && !empty($request->search)) {
            $query->where('nama_jalur', 'like', '%' . $request->search . '%');
        }

        // Filter berdasarkan assembly point
        if ($request->has('assembly_point') && !empty($request->assembly_point)) {
            $query->where('assembly_point', $request->assembly_point);
        }

        $jalurs = $query->paginate(5);
        $assemblyPoints = JalurMitigasi::distinct()->pluck('assembly_point');

        return view('admin.jalur-mitigasi.index', compact('jalurs', 'assemblyPoints'));
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
            'gambar_jalur' => 'nullable|array',
            'gambar_jalur.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'assembly_point' => 'required|string|max:100',
        ]);

        $data = $request->only(['nama_jalur', 'deskripsi_teks', 'assembly_point']);

        // Handle multiple image uploads
        if ($request->hasFile('gambar_jalur')) {
            $uploadedPaths = [];
            foreach ($request->file('gambar_jalur') as $file) {
                if ($file && $file->isValid()) {
                    $path = $file->store('jalur-mitigasi', 'public');
                    $uploadedPaths[] = $path;
                }
            }
            $data['gambar_jalur_url'] = !empty($uploadedPaths) ? json_encode($uploadedPaths) : null;
        }

        JalurMitigasi::create($data);
        return redirect()->route('admin.jalur-mitigasi.index')->with('success', 'Jalur mitigasi berhasil ditambahkan.');
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
            'gambar_jalur' => 'nullable|array',
            'gambar_jalur.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'hapus_gambar' => 'nullable|array',
            'hapus_gambar.*' => 'nullable|string',
            'assembly_point' => 'required|string|max:100',
        ]);

        $jalur = JalurMitigasi::findOrFail($id);

        $data = $request->only(['nama_jalur', 'deskripsi_teks', 'assembly_point']);

        // Get existing images
        $existingImages = $jalur->gambar_jalur_url ? json_decode($jalur->gambar_jalur_url, true) : [];

        // Remove deleted images from storage and array
        if ($request->has('hapus_gambar')) {
            foreach ($request->hapus_gambar as $imagePath) {
                if (\in_array($imagePath, $existingImages)) {
                    Storage::disk('public')->delete($imagePath);
                    $existingImages = array_diff($existingImages, [$imagePath]);
                }
            }
            $existingImages = array_values($existingImages); // Re-index array
        }

        // Handle new image uploads
        if ($request->hasFile('gambar_jalur')) {
            foreach ($request->file('gambar_jalur') as $file) {
                if ($file && $file->isValid()) {
                    $path = $file->store('jalur-mitigasi', 'public');
                    $existingImages[] = $path;
                }
            }
        }

        $data['gambar_jalur_url'] = !empty($existingImages) ? json_encode($existingImages) : null;

        $jalur->update($data);
        return redirect()->route('admin.jalur-mitigasi.index')->with('success', 'Jalur mitigasi berhasil diupdate.');
    }

    public function destroy($id)
    {
        $jalur = JalurMitigasi::findOrFail($id);

        // Delete all associated images from storage
        if ($jalur->gambar_jalur_url) {
            $images = json_decode($jalur->gambar_jalur_url, true);
            if (\is_array($images)) {
                foreach ($images as $imagePath) {
                    Storage::disk('public')->delete($imagePath);
                }
            }
        }

        $jalur->delete();
        return redirect()->route('admin.jalur-mitigasi.index')->with('success', 'Jalur mitigasi berhasil dihapus.');
    }
}
