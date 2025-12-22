<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
    use HasFactory;

    protected $table = 'media';
    protected $primaryKey = 'media_id';

    protected $fillable = [
        'ref_table', // Contoh: 'perangkat_desa', 'lembaga_desa'
        'ref_id',    // ID dari tabel referensi
        'file_name',
        'caption',
        'mime_type',
        'sort_order',
    ];

    protected $casts = [
        'sort_order' => 'integer',
        'ref_id' => 'integer',
    ];

    // Akses URL file secara otomatis
    public function getUrlAttribute()
    {
        if ($this->file_name) {
            return asset('storage/uploads/' . $this->file_name);
        }
        return asset('assets/img/no-image.png'); // Gambar default jika kosong
    }

    // Relasi Manual (Sesuai kode Anda)
    public function parent()
    {
        switch ($this->ref_table) {
            case 'perangkat_desa':
                return $this->belongsTo(PerangkatDesa::class, 'ref_id', 'perangkat_id');
            case 'lembaga_desa':
                return $this->belongsTo(LembagaDesa::class, 'ref_id', 'lembaga_id');
            default:
                return null;
        }
    }

    // Hapus file fisik saat row database dihapus
    protected static function booted()
    {
        static::deleting(function ($media) {
            if ($media->file_name && Storage::exists('public/uploads/' . $media->file_name)) {
                Storage::delete('public/uploads/' . $media->file_name);
            }
        });
    }
}
