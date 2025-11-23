<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class JabatanLembagaSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Ambil ID lembaga dari config
        $lembaga_ids = config('lembaga_desa_seeder.ids');

        if (!$lembaga_ids || count($lembaga_ids) === 0) {
            echo "❌ Jalankan LembagaDesaSeeder terlebih dahulu!\n";
            return;
        }

        $jabatan_batch = [];

        $jabatan_umum = [
            'Ketua', 'Wakil Ketua', 'Sekretaris', 'Bendahara', 'Anggota',
            'Koordinator', 'Staff', 'Manager', 'Supervisor', 'Direktur',
            'Kepala Divisi', 'Wakil Direktur', 'Koordinator Lapangan', 'Administrator'
        ];

        $counter = 0;
        while ($counter < 100) {
            foreach ($lembaga_ids as $lembaga_id) {
                $jabatan_per_lembaga = rand(2, 4); // 2-4 jabatan per lembaga

                for ($j = 0; $j < $jabatan_per_lembaga; $j++) {
                    if ($counter >= 100) break;

                    $jabatan_batch[] = [
                        'lembaga_id' => $lembaga_id,
                        'nama_jabatan' => $jabatan_umum[array_rand($jabatan_umum)] . ' ' . $faker->unique()->word,
                        'level' => $faker->numberBetween(1, 5),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                    $counter++;
                }

                if ($counter >= 100) break;
            }
        }

        // Insert data
        DB::table('jabatan_lembaga')->insert($jabatan_batch);
    }
}
