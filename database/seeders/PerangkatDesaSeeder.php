<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PerangkatDesaSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Ambil ID warga dari config
        $warga_ids = config('warga_seeder.ids');

        if (!$warga_ids || count($warga_ids) === 0) {
            echo "❌ Jalankan WargaSeeder terlebih dahulu!\n";
            return;
        }

        $perangkat_batch = [];

        $jabatan_perangkat = [
            'Kepala Desa', 'Sekretaris Desa', 'Kasi Pemerintahan', 'Kasi Kesejahteraan',
            'Kasi Pelayanan', 'Kaur Keuangan', 'Kaur Umum', 'Kaur Perencanaan',
            'Kadus 1', 'Kadus 2', 'Kadus 3', 'Kadus 4', 'Kadus 5',
            'Staff Administrasi', 'Staff Keuangan', 'Staff Pelayanan'
        ];

        // Pastikan tidak ada duplikasi warga_id
        $available_warga_ids = $warga_ids;
        shuffle($available_warga_ids);

        for ($i = 0; $i < 100; $i++) {
            if (empty($available_warga_ids)) {
                break; // Jika sudah habis warga yang available
            }

            $warga_id = array_pop($available_warga_ids);

            $periode_mulai = $faker->dateTimeBetween('-5 years', '-1 year');
            $periode_selesai = $faker->boolean(70) ? $faker->dateTimeBetween('+1 year', '+3 years') : null;

            $perangkat_batch[] = [
                'warga_id' => $warga_id,
                'jabatan' => $jabatan_perangkat[array_rand($jabatan_perangkat)] . ($i > 15 ? ' ' . ($i - 15) : ''),
                'nip' => $faker->unique()->numerify('19##############'),
                'kontak' => $faker->unique()->e164PhoneNumber,
                'periode_mulai' => $periode_mulai,
                'periode_selesai' => $periode_selesai,
                'foto' => null, // Bisa ditambahkan path foto dummy jika diperlukan
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Insert setiap 20 data
            if (($i + 1) % 20 === 0) {
                DB::table('perangkat_desa')->insert($perangkat_batch);
                $perangkat_batch = [];
            }
        }

        // Insert sisa data
        if (!empty($perangkat_batch)) {
            DB::table('perangkat_desa')->insert($perangkat_batch);
        }
    }
}
