<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang digunakan
     */
    protected $table = 'media';

    /**
     * Nama primary key
     */
    protected $primaryKey = 'media_id';

    /**
     * Tipe data primary key
     */
    protected $keyType = 'int';

    /**
     * Menonaktifkan auto-increment? (default: true)
     * Jika media_id bukan auto-increment, set false
     */
    public $incrementing = true;

    /**
     * Kolom yang dapat diisi secara massal
     */
    protected $fillable = [
        'ref_table',
        'ref_id',
        'file_name',
        'caption',
        'mime_type',
        'sort_order',
    ];

    /**
     * Kolom yang harus disembunyikan dari array/JSON
     */
    protected $hidden = [];

    /**
     * Tipe data casting
     */
    protected $casts = [
        'ref_id' => 'integer',
        'sort_order' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relasi polymorphic: Mendapatkan parent model
     */
    public function model()
    {
        return $this->morphTo(__FUNCTION__, 'ref_table', 'ref_id');
    }

    /**
     * Scope untuk mengambil media berdasarkan tabel referensi
     */
    public function scopeByReference($query, $table, $id = null)
    {
        $query->where('ref_table', $table);

        if ($id) {
            $query->where('ref_id', $id);
        }

        return $query;
    }

    /**
     * Scope untuk mengurutkan berdasarkan sort_order
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc');
    }

    /**
     * Accessor untuk URL lengkap file (contoh)
     */
    public function getFileUrlAttribute()
    {
        return asset('storage/media/' . $this->file_name);
    }

    /**
     * Accessor untuk tipe file (gambar/dokumen)
     */
    public function getFileTypeAttribute()
    {
        if (str_starts_with($this->mime_type, 'image/')) {
            return 'image';
        }

        return 'document';
    }
}
