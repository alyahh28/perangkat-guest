<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class JabatanSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $lembaga_ids = config('lembaga_seeder.ids');

        if (!$lembaga_ids) {
            echo "❌ Jalankan LembagaSeeder terlebih dahulu!\n";
            return;
        }

        $jabatan_batch = [];

        foreach ($lembaga_ids as $id) {
            // 3 jabatan setiap lembaga
            for ($i = 1; $i <= 3; $i++) {
                $jabatan_batch[] = [
                    'lembaga_id'   => $id,
                    'nama_jabatan' => $faker->jobTitle,
                    'level'        => $i,
                    'created_at'   => now(),
                    'updated_at'   => now(),
                ];
            }
        }

        DB::table('jabatan_lembaga')->insert($jabatan_batch);
    }
}
