<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Media extends Model
{
    use HasFactory;

    protected $table = 'media';
    protected $primaryKey = 'media_id';

    protected $fillable = [
        'ref_table',
        'ref_id',
        'file_name',
        'caption',
        'mime_type',
        'sort_order',
    ];

    protected $casts = [
        'sort_order' => 'integer',
        'ref_id' => 'integer',
    ];

    /**
     * Get the full URL of the media file
     */
    public function getUrlAttribute()
    {
        return asset('storage/uploads/' . $this->file_name);
    }

    /**
     * Get the parent model (PerangkatDesa or LembagaDesa)
     */
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
}
