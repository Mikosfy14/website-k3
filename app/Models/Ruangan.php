<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;

    protected $table = 'ruangan';
    protected $primaryKey = 'id_ruangan';

    protected $fillable = ['id_lantai', 'nama_ruangan', 'kode_ruangan'];

    // Relasi: Ruangan belongs to Lantai
    public function lantai()
    {
        return $this->belongsTo(Lantai::class, 'id_lantai', 'id_lantai');
    }
}
