<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class LembagaDesa extends Model
{
    use HasFactory;

    protected $table = 'lembaga_desa';

    // PERBAIKAN PENTING: Memberitahu Laravel nama Primary Key kita
    protected $primaryKey = 'lembaga_id';

    protected $fillable = [
        'nama_lembaga',
        'deskripsi',
        'kontak',
        'logo',
        'media_id',
    ];

    // ========== RELASI ==========

    public function media()
    {
        return $this->belongsTo(Media::class, 'media_id');
    }

    public function galeri()
    {
        return $this->hasMany(Media::class, 'ref_id', 'lembaga_id')
                    ->where('ref_table', 'lembaga_desa');
    }

    public function jabatans()
    {
        // Relasi ke Jabatan (One to Many)
        return $this->hasMany(JabatanLembaga::class, 'lembaga_id', 'lembaga_id');
    }

    // ========== SCOPES & ACCESSORS (Sesuai kode kamu sebelumnya) ==========

    public function scopeFilter(Builder $query, $request, array $filterableColumns): Builder
    {
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                $query->where($column, $request->input($column));
            }
        }
        return $query;
    }

    public function scopeSearch($query, $request, array $columns)
    {
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request, $columns) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'LIKE', '%' . $request->search . '%');
                }
            });
        }
        return $query;
    }

    public function getLogoUrlAttribute()
    {
        if ($this->media) {
            return asset('storage/' . $this->media->path);
        }
        return $this->logo ? asset('storage/logos/' . $this->logo) : asset('images/default-logo.png');
    }
}
