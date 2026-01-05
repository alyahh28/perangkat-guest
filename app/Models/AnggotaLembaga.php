<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggotaLembaga extends Model
{
    use HasFactory;

    // Pastikan nama tabel sesuai dengan migrasi (anggota_lembagas)
    protected $table = 'anggota_lembagas';

    // Primary Key tabel ini standar (id), jadi tidak perlu diubah.
    protected $primaryKey = 'anggota_id';

    // PERBAIKAN PENTING: Tambahkan fillable agar form bisa menyimpan data
    protected $fillable = [
        'lembaga_id',
        'warga_id',
        'jabatan_id',
        'tgl_mulai',
        'tgl_selesai',
    ];

    // ========== RELASI ==========

    public function lembaga()
    {
        // belongsTo(ModelTujuan, ForeignKeyDiTabelIni, PrimaryKeyDiTabelTujuan)
        return $this->belongsTo(LembagaDesa::class, 'lembaga_id', 'lembaga_id');
    }

    public function jabatan()
    {
        // belongsTo(ModelTujuan, ForeignKeyDiTabelIni, PrimaryKeyDiTabelTujuan)
        return $this->belongsTo(JabatanLembaga::class, 'jabatan_id', 'jabatan_id');
    }

    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id', 'warga_id');
    }

    public function foto_profile()
    {
        return $this->hasOne(Media::class, 'ref_id', 'anggota_id')
                    ->where('ref_table', 'anggota_lembagas')
                    ->latest();
    }
}
