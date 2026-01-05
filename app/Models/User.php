<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'role',
        'activiti',
        'media_id', // TAMBAHKAN
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Scope untuk filtering
     */
    public function scopeFilter(Builder $query, $request, array $filterableColumns): Builder
    {
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                $query->where($column, $request->input($column));
            }
        }
        return $query;
    }

    /**
     * Scope untuk searching
     */
    public function scopeSearch($query, $request, array $columns): Builder
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

    // ========== RELASI BARU ==========

    /**
     * Relasi ke Media (untuk foto profil)
     */
 public function media()
{
    return $this->belongsTo(Media::class, 'media_id', 'media_id');
}

/**
 * Accessor untuk foto URL dari media_id
 */
public function getFotoUrlAttribute()
{
    // Coba ambil dari media_id di tabel media
    if ($this->media_id && $this->media) {
        return asset('storage/users/' . $this->media->file_name);
    }

    // Fallback: cari di tabel media berdasarkan ref_id
    $mediaFromRef = Media::where('ref_table', 'users')
                        ->where('ref_id', $this->id)
                        ->first();

    if ($mediaFromRef) {
        // Update media_id di user untuk konsistensi
        $this->media_id = $mediaFromRef->media_id;
        $this->save();

        return asset('storage/users/' . $mediaFromRef->file_name);
    }

    // Default
    return asset('storage/users/user_1.jpg');
}
}
