<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class WargaSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $warga_batch = [];

        // Agama yang umum di Indonesia
        $agama_list = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'];

        // Pekerjaan yang realistis untuk warga desa
        $pekerjaan_list = [
            'Petani', 'Nelayan', 'Pedagang', 'PNS', 'Guru', 'Buruh Tani',
            'Wiraswasta', 'Karyawan Swasta', 'Ibu Rumah Tangga', 'Pensiunan',
            'Pengrajin', 'Sopir', 'Tukang Kayu', 'Tukang Batu', 'Penjahit'
        ];

        for ($i = 0; $i < 100; $i++) {
            // Generate NIK yang valid (16 digit)
            $nik = $faker->unique()->numerify('32##############'); // 32 + 14 digit

            // Pastikan NIK tepat 16 digit
            if (strlen($nik) > 16) {
                $nik = substr($nik, 0, 16);
            }

            $warga_batch[] = [
                'no_ktp' => $nik,
                'nama' => $faker->unique()->name,
                'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan']),
                'agama' => $agama_list[array_rand($agama_list)],
                'pekerjaan' => $pekerjaan_list[array_rand($pekerjaan_list)],
                'telp' => $faker->numerify('08##########'), // Format Indonesia
                'email' => $faker->unique()->safeEmail,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Insert setiap 10 data untuk lebih aman
            if (($i + 1) % 10 === 0) {
                DB::table('warga')->insert($warga_batch);
                $warga_batch = [];
            }
        }

        // Insert sisa data
        if (!empty($warga_batch)) {
            DB::table('warga')->insert($warga_batch);
        }

        // Simpan ID warga untuk seeder lainnya
        $warga_ids = DB::table('warga')->pluck('warga_id')->toArray();
        config(['warga_seeder.ids' => $warga_ids]);

        echo "✅ WargaSeeder berhasil: 100 data warga dibuat\n";
    }
}
