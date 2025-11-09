<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gedung extends Model
{
    use HasFactory;

    protected $table = 'gedung';  // nama tabel
    protected $primaryKey = 'id_gedung';  // primary custom
    public $incrementing = true;  // auto-increment

    protected $fillable = ['nama_gedung', 'alamat_gedung', 'deskripsi_singkat'];

    // Relasi: Gedung has many Lantai
    public function lantais()
    {
        return $this->hasMany(Lantai::class, 'id_gedung', 'id_gedung');
    }
}
