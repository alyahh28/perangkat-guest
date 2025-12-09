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
        'status_aktif',
    ];

    // Relasi ke Warga
    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id', 'warga_id');
    }

    /**
     * PERBAIKAN RELASI MEDIA
     * Saya menghapus ->where('reference_table') yang bikin error.
     * * PENTING: Periksa database tabel 'media' kamu.
     * Kolom apa yang menyimpan ID Perangkat Desa?
     * Jika namanya 'perangkat_id', biarkan kode di bawah ini.
     * Jika namanya 'perangkat_desa_id' atau 'reference_id', ganti parameter kedua.
     */
    public function media()
    {
        return $this->hasMany(Media::class, 'ref_id', 'perangkat_id')
            ->where('ref_table', 'perangkat_desa');
    }

}
