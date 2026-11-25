<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    /**
     * Serve file dari disk 'public' lewat route Laravel, buat hosting
     * yang tidak mengizinkan symlink() (storage:link gagal, umum di
     * shared hosting gratis). Dipakai hanya kalau
     * config('filesystems.serve_public_via_route') true - lihat
     * JalurGambar::getUrlAttribute().
     */
    public function show(string $path)
    {
        $disk = Storage::disk('public');

        if (!$disk->exists($path)) {
            abort(404);
        }

        return $disk->response($path, null, [
            'Cache-Control' => 'public, max-age=604800, immutable',
        ]);
    }
}
