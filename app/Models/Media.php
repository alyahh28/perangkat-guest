<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    // Nama tabel yang direferensikan oleh model ini
    protected $table = 'media';

    // Primary key untuk tabel media
    protected $primaryKey = 'media_id';

    // Kolom yang dapat diisi secara massal (mass assignable)
    protected $fillable = [
        'ref_table',
        'ref_id',
        'file_name',
        'caption',
        'mime_type',
        'sort_order',
    ];

    // Kolom yang harus di-cast ke tipe data tertentu saat diambil
    protected $casts = [
        // 'ref_id' => 'integer', // Opsional, bisa ditambahkan jika perlu
        'sort_order' => 'integer',
    ];

    // Relasi ke model lain (opsional, untuk contoh)
    // public function parent()
    // {
    //     // Relasi dinamis, tergantung pada nilai ref_table
    //     $relatedModel = 'App\Models\\' . ucfirst(Str::singular($this->ref_table));
    //     return $this->morphTo('ref', 'ref_table', 'ref_id');
    // }
}
