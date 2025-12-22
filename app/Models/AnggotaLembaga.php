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

    // PERBAIKAN PENTING: Tambahkan fillable agar form bisa menyimpan data
    protected $fillable = [
        'lembaga_desa_id',
        'jabatan_lembaga_id',
        'nama',
        'nomor_anggota',
        'foto',
    ];

    // ========== RELASI ==========

    public function lembaga()
    {
        // belongsTo(ModelTujuan, ForeignKeyDiTabelIni, PrimaryKeyDiTabelTujuan)
        return $this->belongsTo(LembagaDesa::class, 'lembaga_desa_id', 'lembaga_id');
    }

    public function jabatan()
    {
        // belongsTo(ModelTujuan, ForeignKeyDiTabelIni, PrimaryKeyDiTabelTujuan)
        return $this->belongsTo(JabatanLembaga::class, 'jabatan_lembaga_id', 'jabatan_id');
    }
}
