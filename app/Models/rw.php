<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rw extends Model
{
    use HasFactory;

    protected $table = 'rws';

    protected $primaryKey = 'rw_id';

    protected $fillable = [
        'nomor_rw',
        'ketua_rw_warga_id',
        'keterangan',
    ];

    public function ketua()
    {
        return $this->belongsTo(Warga::class, 'ketua_rw_warga_id', 'warga_id');
    }

    public function foto_profile()
    {
        return $this->hasOne(Media::class, 'ref_id', 'rw_id')
                    ->where('ref_table', 'rws')
                    ->latest(); // Ambil yang terbaru jika ada duplikat
    }

    // Tambahkan ini: Satu RW memiliki banyak RT
    public function rts()
    {
        return $this->hasMany(Rt::class, 'rw_id', 'rw_id');
    }
}
