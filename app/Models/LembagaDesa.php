<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class LembagaDesa extends Model
{
    use HasFactory;

    protected $table = 'lembaga_desa';
    protected $primaryKey = 'lembaga_id';

    protected $fillable = [
        'nama_lembaga',
        'deskripsi',
        'kontak',
        'logo' // TAMBAHAN KOLOM LOGO
    ];

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

    // Getter untuk logo URL
    public function getLogoUrlAttribute()
    {
        if ($this->logo) {
            return asset('storage/logos/' . $this->logo);
        }
        return asset('storage/logos/default-logo.png'); // Logo default jika tidak ada
    }
}

