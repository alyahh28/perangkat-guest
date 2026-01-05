<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; // Jangan lupa import Auth

class CheckIsLogin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            // Sesuaikan route('login') dengan nama route di web.php kamu
            return redirect()->route('login')->withErrors('Silahkan login terlebih dahulu!');
        }

        return $next($request);
    }
}
