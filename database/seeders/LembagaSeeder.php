<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class LembagaSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $lembaga_ids = [];

        // Buat 5 lembaga dummy
        for ($i = 0; $i < 5; $i++) {
            $nama = 'Lembaga ' . $faker->unique()->company;

            $id = DB::table('lembaga_desa')->insertGetId([
                'nama_lembaga' => $nama,
                'deskripsi'    => $faker->sentence(8),
                'kontak'       => $faker->e164PhoneNumber,
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);

            $lembaga_ids[] = $id;
        }

        // Simpan agar bisa dibaca JabatanSeeder
        config(['lembaga_seeder.ids' => $lembaga_ids]);
    }
}
