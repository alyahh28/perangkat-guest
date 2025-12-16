<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class JabatanLembagaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID'); // Menggunakan locale Indonesia

        // Daftar jabatan manual agar terlihat lebih nyata untuk konteks Lembaga
        $pilihanJabatan = [
            'Ketua',
            'Wakil Ketua',
            'Sekretaris I',
            'Sekretaris II',
            'Bendahara',
            'Anggota',
            'Koordinator Bidang',
            'Seksi Keamanan',
            'Seksi Pembangunan',
            'Penasehat'
        ];

        $data = [];

        for ($i = 0; $i < 100; $i++) {
            $data[] = [
                // Asumsi: Pastikan kamu punya data di tabel lembaga dengan ID 1 sampai 10.
                // Jika tabel lembaga masih kosong, angka ini bisa menyebabkan error Foreign Key.
                'lembaga_id'   => $faker->numberBetween(1, 10),

                'nama_jabatan' => $faker->randomElement($pilihanJabatan),
                'level'        => $faker->numberBetween(1, 5), // Level 1 (Tinggi) - 5 (Rendah)
                'created_at'   => now(),
                'updated_at'   => now(),
            ];
        }

        // Insert batch (sekaligus) agar performa lebih cepat
        DB::table('jabatan_lembaga')->insert($data);
    }
}
