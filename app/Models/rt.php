<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rt extends Model
{
    use HasFactory;

    protected $table = 'rts';

    protected $fillable = [
        'rw_id',
        'no_rt',
        'ketua_rt',
    ];

    // Relasi: RT milik satu RW
    public function rw()
    {
        return $this->belongsTo(Rw::class);
    }
}
