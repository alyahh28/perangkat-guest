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
        'foto', // Kolom lama (optional)
        'media_id', // TAMBAHKAN
        'periode_mulai',
        'periode_selesai',
    ];

    // ========== RELASI ==========

    /**
     * Relasi ke Warga
     */
    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id', 'warga_id');
    }

    /**
     * Relasi ke Media (untuk foto perangkat desa)
     */
    public function media()
    {
        return $this->belongsTo(Media::class, 'media_id');
    }

    /**
     * Relasi ke Media untuk galeri (multiple media)
     */
    public function galeri()
    {
        return $this->hasMany(Media::class, 'ref_id', 'perangkat_id')
            ->where('ref_table', 'perangkat_desa');
    }

    // ========== ACCESSOR ==========

    /**
     * Accessor untuk URL foto
     * Priority: media_id > foto (kolom lama)
     */
    public function getFotoUrlAttribute()
    {
        if ($this->media) {
            return asset('storage/' . $this->media->path);
        }

        if ($this->foto) {
            return asset('storage/foto-perangkat/' . $this->foto);
        }

        return asset('images/default-perangkat.png');
    }

    /**
     * Accessor untuk foto thumbnail
     */
    public function getFotoThumbnailAttribute()
    {
        $url = $this->foto_url;
        return str_replace('.jpg', '-thumb.jpg', $url);
    }

    /**
     * Mendapatkan semua media terkait (foto + galeri)
     */
    public function getAllMediaAttribute()
    {
        $media = collect();

        // Foto utama
        if ($this->media) {
            $media->push($this->media);
        }

        // Galeri
        if ($this->galeri->isNotEmpty()) {
            $media = $media->merge($this->galeri);
        }

        return $media->unique('id');
    }

    /**
     * Scope untuk perangkat dengan foto
     */
    public function scopeWithFoto($query)
    {
        return $query->whereNotNull('media_id')->orWhereNotNull('foto');
    }

    /**
     * Scope untuk perangkat aktif (berdasarkan periode)
     */
    public function scopeAktif($query)
    {
        $now = now()->format('Y-m-d');
        return $query->where('periode_mulai', '<=', $now)
                     ->where(function ($q) use ($now) {
                         $q->where('periode_selesai', '>=', $now)
                           ->orWhereNull('periode_selesai');
                     });
    }
}
