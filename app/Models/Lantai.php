<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lantai extends Model
{
    use HasFactory;

    protected $table = 'lantai';
    protected $primaryKey = 'id_lantai';

    protected $fillable = ['id_gedung', 'id_jalur', 'nama_lantai'];

    // Relasi: Lantai belongs to Gedung
    public function gedung()
    {
        return $this->belongsTo(Gedung::class, 'id_gedung', 'id_gedung');
    }

    // Lantai belongs to JalurMitigasi
    public function jalurMitigasi()
    {
        return $this->belongsTo(JalurMitigasi::class, 'id_jalur', 'id_jalur');
    }

    // Lantai has many Ruangan
    public function ruangans()
    {
        return $this->hasMany(Ruangan::class, 'id_lantai', 'id_lantai');
    }
}
