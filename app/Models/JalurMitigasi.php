<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JalurMitigasi extends Model
{
    use HasFactory;

    protected $table = 'jalur_mitigasi';
    protected $primaryKey = 'id_jalur';

    protected $fillable = ['nama_jalur', 'deskripsi_teks', 'assembly_point'];

    // Relasi: Jalur has many Lantai (asumsi one-to-many, kalau one-to-one bisa belongsTo)
    public function lantais()
    {
        return $this->hasMany(Lantai::class, 'id_jalur', 'id_jalur');
    }

    // Relasi: Jalur has many gambar (satu baris per gambar, urut sesuai upload)
    public function gambars()
    {
        return $this->hasMany(JalurGambar::class, 'id_jalur', 'id_jalur')->orderBy('urutan');
    }

    // Accessor untuk mendapatkan array path gambar
    public function getGambarUrlsAttribute()
    {
        return $this->gambars->pluck('path')->all();
    }

    // Accessor untuk mendapatkan URL gambar dengan full path
    // (dibentuk oleh JalurGambar::getUrlAttribute, lewat disk config)
    public function getGambarFullUrlsAttribute()
    {
        return $this->gambars->pluck('url')->all();
    }
}
