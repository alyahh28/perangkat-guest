<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AnggotaLembaga;
use App\Models\LembagaDesa;
use App\Models\JabatanLembaga;
use Faker\Factory as Faker;

class AnggotaLembagaSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $lembagaIds = LembagaDesa::pluck('id')->toArray();
        $jabatanIds = JabatanLembaga::pluck('id')->toArray();

        if (empty($lembagaIds) || empty($jabatanIds)) {
            $this->command->info('Harap isi data LembagaDesa dan JabatanLembaga terlebih dahulu!');
            return;
        }

        for ($i = 1; $i <= 50; $i++) {
            AnggotaLembaga::create([
                'lembaga_desa_id' => $faker->randomElement($lembagaIds),
                'jabatan_lembaga_id' => $faker->randomElement($jabatanIds),
                'nama' => $faker->name,
                'nomor_anggota' => $faker->numerify('ANG-####'),
                'foto' => null, // Biarkan kosong dulu
            ]);
        }
    }
}
