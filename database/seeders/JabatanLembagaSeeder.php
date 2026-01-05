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

        // Ambil ID lembaga yang valid dari database
        $lembagaIds = DB::table('lembaga_desa')->pluck('lembaga_id')->toArray();

        if (empty($lembagaIds)) {
            $this->command->error('Error: Tabel lembaga_desa kosong. Harap jalankan LembagaDesaSeeder terlebih dahulu.');
            return;
        }

        $data = [];

        for ($i = 0; $i < 100; $i++) {
            $data[] = [
                // Gunakan ID yang benar-benar ada
                'lembaga_id'   => $faker->randomElement($lembagaIds),

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
