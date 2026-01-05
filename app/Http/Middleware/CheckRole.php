<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; // Jangan lupa import Auth
use Illuminate\Support\Str;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Cek apakah user login, DAN (apakah rolenya sesuai ATAU dia adalah Admin)
        if (Auth::check() && (Auth::user()->role == $role || Str::lower(Auth::user()->role) == 'admin')) {
            return $next($request);
        }

        return abort(403, 'Akses Ditolak: Anda tidak memiliki izin.');
    }
}
