<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder; // Tambahkan import ini

class JabatanLembaga extends Model
{
    use HasFactory;

    protected $table = 'jabatan_lembaga';
    protected $primaryKey = 'jabatan_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'lembaga_id',
        'nama_jabatan',
        'level'
    ];

    protected $casts = [
        'level' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relasi ke AnggotaLembaga
    public function anggota()
    {
        return $this->hasMany(AnggotaLembaga::class, 'jabatan_lembaga_id', 'jabatan_id');
    }

    // Relasi ke LembagaDesa
    public function lembaga()
    {
        return $this->belongsTo(LembagaDesa::class, 'lembaga_id', 'lembaga_id');
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
}
