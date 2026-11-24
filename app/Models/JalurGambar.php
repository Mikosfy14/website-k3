<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class JalurGambar extends Model
{
    protected $table = 'jalur_gambar';

    protected $fillable = ['id_jalur', 'path', 'urutan'];

    public function jalur()
    {
        return $this->belongsTo(JalurMitigasi::class, 'id_jalur', 'id_jalur');
    }

    /**
     * URL publik gambar, lewat disk config (bukan path hardcoded).
     * Satu-satunya tempat yang tahu cara membentuk URL dari path -
     * kalau nanti disk 'public' diganti ke S3/Cloudinary-compatible,
     * cukup ubah config/filesystems.php, tidak perlu ubah view manapun.
     */
    public function getUrlAttribute(): string
    {
        return Storage::disk('public')->url($this->path);
    }
}
