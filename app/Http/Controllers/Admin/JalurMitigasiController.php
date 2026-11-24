<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JalurMitigasi;
use App\Models\JalurGambar;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class JalurMitigasiController extends Controller
{
    public function index(Request $request)
    {
        $query = JalurMitigasi::with('gambars');

        // Search berdasarkan nama jalur
        if ($request->has('search') && !empty($request->search)) {
            $query->where('nama_jalur', 'like', '%' . $request->search . '%');
        }

        // Filter berdasarkan assembly point
        if ($request->has('assembly_point') && !empty($request->assembly_point)) {
            $query->where('assembly_point', $request->assembly_point);
        }

        $jalurs = $query->paginate(5)->withQueryString();
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
            'gambar_jalur.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'assembly_point' => 'required|string|max:100',
        ]);

        $data = $request->only(['nama_jalur', 'deskripsi_teks', 'assembly_point']);

        $jalur = JalurMitigasi::create($data);

        // Handle multiple image uploads - satu baris JalurGambar per file
        if ($request->hasFile('gambar_jalur')) {
            $urutan = 0;
            foreach ($request->file('gambar_jalur') as $file) {
                if ($file && $file->isValid()) {
                    $path = $file->store('jalur-mitigasi', 'public');
                    JalurGambar::create([
                        'id_jalur' => $jalur->id_jalur,
                        'path' => $path,
                        'urutan' => $urutan++,
                    ]);
                }
            }
        }

        return redirect()->route('admin.jalur-mitigasi.index')->with('success', 'Jalur mitigasi berhasil ditambahkan.');
    }

    public function show($id)
    {
        $jalur = JalurMitigasi::with('gambars')->findOrFail($id);
        return view('admin.jalur-mitigasi.show', compact('jalur'));
    }

    public function edit($id)
    {
        $jalur = JalurMitigasi::with('gambars')->findOrFail($id);
        return view('admin.jalur-mitigasi.edit', compact('jalur'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_jalur' => 'required|string|max:255',
            'deskripsi_teks' => 'required|string',
            'gambar_jalur' => 'nullable|array',
            'gambar_jalur.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'hapus_gambar' => 'nullable|array',
            'hapus_gambar.*' => 'nullable|string',
            'assembly_point' => 'required|string|max:100',
        ]);

        $jalur = JalurMitigasi::with('gambars')->findOrFail($id);

        $data = $request->only(['nama_jalur', 'deskripsi_teks', 'assembly_point']);

        // Hapus gambar yang ditandai untuk dihapus (file di disk + baris DB)
        if ($request->has('hapus_gambar')) {
            $toDelete = $jalur->gambars->whereIn('path', $request->hapus_gambar);
            foreach ($toDelete as $gambar) {
                Storage::disk('public')->delete($gambar->path);
                $gambar->delete();
            }
        }

        // Tambah gambar baru, lanjutkan urutan dari yang tersisa
        if ($request->hasFile('gambar_jalur')) {
            $urutan = (int) $jalur->gambars()->max('urutan') + 1;
            foreach ($request->file('gambar_jalur') as $file) {
                if ($file && $file->isValid()) {
                    $path = $file->store('jalur-mitigasi', 'public');
                    JalurGambar::create([
                        'id_jalur' => $jalur->id_jalur,
                        'path' => $path,
                        'urutan' => $urutan++,
                    ]);
                }
            }
        }

        $jalur->update($data);
        return redirect()->route('admin.jalur-mitigasi.index')->with('success', 'Jalur mitigasi berhasil diupdate.');
    }

    // TAMBAHKAN METHOD INI UNTUK DELETE GAMBAR VIA AJAX
    public function deleteImage(Request $request, $id)
    {
        try {
            $jalur = JalurMitigasi::findOrFail($id);
            $imagePath = $request->image_path;

            $gambar = $jalur->gambars()->where('path', $imagePath)->first();

            if ($gambar) {
                Storage::disk('public')->delete($gambar->path);
                $gambar->delete();

                return response()->json([
                    'success' => true,
                    'message' => 'Gambar berhasil dihapus'
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Gambar tidak ditemukan'
            ], 404);
        } catch (\Exception $e) {
            Log::error('Error deleting image: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus gambar.'
            ], 500);
        }
    }

    public function destroy($id)
    {
        $jalur = JalurMitigasi::with('gambars')->findOrFail($id);

        // Hapus semua file gambar fisik; baris jalur_gambar ikut terhapus
        // otomatis lewat foreign key onDelete('cascade').
        foreach ($jalur->gambars as $gambar) {
            Storage::disk('public')->delete($gambar->path);
        }

        $jalur->delete();
        return redirect()->route('admin.jalur-mitigasi.index')->with('success', 'Jalur mitigasi berhasil dihapus.');
    }
}
