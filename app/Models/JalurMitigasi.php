<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JalurMitigasi extends Model
{
    use HasFactory;

    protected $table = 'jalur_mitigasi';
    protected $primaryKey = 'id_jalur';

    protected $fillable = ['nama_jalur', 'deskripsi_teks', 'gambar_jalur_url', 'assembly_point'];

    // Relasi: Jalur has many Lantai (asumsi one-to-many, kalau one-to-one bisa belongsTo)
    public function lantais()
    {
        return $this->hasMany(Lantai::class, 'id_jalur', 'id_jalur');
    }

    // Accessor untuk mendapatkan array gambar
    public function getGambarUrlsAttribute()
    {
        if (empty($this->gambar_jalur_url)) {
            return [];
        }

        $decoded = json_decode($this->gambar_jalur_url, true);
        return is_array($decoded) ? $decoded : [];
    }

    // Accessor untuk mendapatkan URL gambar dengan full path
    public function getGambarFullUrlsAttribute()
    {
        return array_map(function($path) {
            return asset('storage/' . $path);
        }, $this->gambar_urls);
    }
}
