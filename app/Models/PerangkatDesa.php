<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PerangkatDesa extends Model
{
    protected $table = 'perangkat_desa';
    protected $primaryKey = 'perangkat_id';
    protected $fillable = [
        'warga_id',
        'jabatan',
        'nip',
        'kontak',
        'periode_mulai',
        'periode_selesai',
        'foto',
    ];

    /**
     * Get the warga that owns the PerangkatDesa
     */
    public function warga(): BelongsTo
    {
        return $this->belongsTo(Warga::class, 'warga_id', 'warga_id');
    }
}
