<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rw;
use Faker\Factory as Faker;

class RwSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $wargaIds = \App\Models\Warga::pluck('warga_id')->toArray();

        for ($i = 1; $i <= 20; $i++) {
            Rw::create([
                'nomor_rw' => str_pad($i, 3, '0', STR_PAD_LEFT),
                'ketua_rw_warga_id' => !empty($wargaIds) ? $faker->randomElement($wargaIds) : null,
                'keterangan' => $faker->sentence(),
            ]);
        }
    }
}
