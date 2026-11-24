<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JalurGambar extends Model
{
    protected $table = 'jalur_gambar';

    protected $fillable = ['id_jalur', 'path', 'urutan'];

    public function jalur()
    {
        return $this->belongsTo(JalurMitigasi::class, 'id_jalur', 'id_jalur');
    }
}
