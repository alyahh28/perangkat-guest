<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rw extends Model
{
    use HasFactory;

    protected $table = 'rws';

    protected $fillable = [
        'no_rw',
        'ketua_rw',
    ];

    // Tambahkan ini: Satu RW memiliki banyak RT
    public function rts()
    {
        return $this->hasMany(Rt::class);
    }
}
