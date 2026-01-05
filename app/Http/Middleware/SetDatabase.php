<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class SetDatabase
{
    public function handle($request, Closure $next)
    {
        // Cek logika (bisa berdasarkan URL, Session, atau User Role)
        // Contoh: Jika URL mengandung kata 'admin'
        if ($request->is('admin/*') || $request->is('admin')) {
            $dbName = 'perangkatadmin';
        } else {
            $dbName = 'perangkat-guest';
        }

        // Putuskan koneksi default
        DB::purge('mysql');

        // Set database target secara dinamis
        Config::set('database.connections.mysql.database', $dbName);

        // Sambungkan ulang
        DB::reconnect('mysql');

        return $next($request);
    }
}
