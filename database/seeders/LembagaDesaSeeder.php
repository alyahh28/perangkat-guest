<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class LembagaDesaSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $lembaga_batch = [];

        $jenis_lembaga = [
            'Badan Permusyawaratan Desa',
            'Lembaga Pemberdayaan Masyarakat',
            'Pemberdayaan Kemberdayaan Kesejahteraan Keluarga',
            'Karang Taruna',
            'Kelompok Tani',
            'Kelompok Nelayan',
            'Lembaga Adat',
            'Koperasi Desa',
            'BUMDes',
            'Forum Komunikasi Pemuda',
            'Tim Penggerak PKK',
            'Rukun Tetangga',
            'Rukun Warga',
            'Kelompok Sadar Wisata',
            'Paguyuban Petani',
            'Kelompok Perempuan',
            'Majelis Taklim',
            'Sanggar Seni',
            'Klub Olahraga',
            'Komunitas Pemuda'
        ];

        for ($i = 0; $i < 100; $i++) {
            $jenis = $jenis_lembaga[array_rand($jenis_lembaga)];

            // Gunakan unique pada kombinasi yang lebih variatif
            $nama_lembaga = $jenis . ' ' . $faker->unique()->word . ' ' . $faker->city;

            $lembaga_batch[] = [
                'nama_lembaga' => $nama_lembaga,
                'deskripsi' => $faker->sentence(12),
                'kontak' => $faker->unique()->e164PhoneNumber,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Insert setiap 10 data untuk menghindari memory issue
            if (($i + 1) % 10 === 0) {
                DB::table('lembaga_desa')->insert($lembaga_batch);
                $lembaga_batch = [];
            }
        }

        // Insert sisa data
        if (!empty($lembaga_batch)) {
            DB::table('lembaga_desa')->insert($lembaga_batch);
        }

        // Simpan ID lembaga untuk seeder lainnya
        $lembaga_ids = DB::table('lembaga_desa')->pluck('lembaga_id')->toArray();
        config(['lembaga_desa_seeder.ids' => $lembaga_ids]);

        echo "✅ LembagaDesaSeeder berhasil: 100 data lembaga desa dibuat\n";
    }
}
