<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerangkatDesa extends Model
{
    use HasFactory;

    protected $table      = 'perangkat_desa';
    protected $primaryKey = 'perangkat_id';

    protected $fillable = [
        'warga_id',
        'jabatan',
        'nip',
        'kontak',
        'foto',
        'periode_mulai',
        'periode_selesai',
    ];

    // Relasi ke Warga
    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id', 'warga_id');
    }

    // Relasi ke Media (Galeri)
    public function media()
    {
        return $this->hasMany(Media::class, 'ref_id', 'perangkat_id')
            ->where('ref_table', 'perangkat_desa');
    }
}
