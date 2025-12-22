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

        for ($i = 1; $i <= 100; $i++) {
            Rw::create([
                // Membuat no RW unik (misal: 001, 002... 100)
                'no_rw' => str_pad($i, 3, '0', STR_PAD_LEFT),
                'ketua_rw' => $faker->name,
            ]);
        }
    }
}
