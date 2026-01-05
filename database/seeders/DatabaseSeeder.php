<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Panggil seeder secara berurutan agar foreign key aman
        $this->call([
            UserSeeder::class,           // User sistem
            WargaSeeder::class,          // Warga (Induk data penduduk)
            MediaSeeder::class,          // Media (file pendukung)
            
            // Wilayah
            RwSeeder::class,             // RW
            RtSeeder::class,             // RT (Butuh RW)
            
            // Lembaga
            LembagaDesaSeeder::class,    // Lembaga
            JabatanLembagaSeeder::class, // Jabatan (Butuh Lembaga)
            AnggotaLembagaSeeder::class, // Anggota (Butuh Jabatan & Lembaga)
            
            // Perangkat Desa
            PerangkatDesaSeeder::class,  // Perangkat (Butuh Warga & Media)
        ]);
    }
}
