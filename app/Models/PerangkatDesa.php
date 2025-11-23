<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder; // Tambahkan import ini

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

    // Scope untuk filter status aktif
    public function scopeStatus($query, $status)
    {
        if ($status == 'Aktif') {
            return $query->where(function($q) {
                $q->whereNull('periode_selesai')
                  ->orWhere('periode_selesai', '>', now());
            });
        } elseif ($status == 'Tidak Aktif') {
            return $query->whereNotNull('periode_selesai')
                         ->where('periode_selesai', '<=', now());
        }
        return $query;
    }
}
