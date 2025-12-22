<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rt;
use App\Models\Rw;
use Faker\Factory as Faker;

class RtSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Ambil semua ID RW yang ada
        $rwIds = Rw::pluck('id')->toArray();

        // Pastikan ada data RW dulu sebelum buat RT
        if (empty($rwIds)) {
            $this->command->info('Harap jalankan RwSeeder terlebih dahulu!');
            return;
        }

        for ($i = 1; $i <= 100; $i++) {
            Rt::create([
                'rw_id' => $faker->randomElement($rwIds), // Pilih RW secara acak
                'no_rt' => str_pad($faker->numberBetween(1, 15), 3, '0', STR_PAD_LEFT), // 001 - 015
                'ketua_rt' => $faker->name,
            ]);
        }
    }
}
