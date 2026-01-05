<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PerangkatDesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // AMBIL ID NYATA DULU:
        // Ambil semua 'warga_id' yang benar-benar ada di tabel warga
        $wargaIds = DB::table('warga')->pluck('warga_id')->toArray();

        // Pengecekan keamanan: Jika tabel warga kosong, hentikan proses biar tidak error aneh
        if (empty($wargaIds)) {
            $this->command->error('Error: Tabel warga masih kosong! Harap jalankan WargaSeeder terlebih dahulu.');
            return;
        }

        $jabatanList = [
            'Kepala Desa',
            'Sekretaris Desa',
            'Kaur Keuangan',
            'Kaur Perencanaan',
            'Kaur Tata Usaha',
            'Kasi Pemerintahan',
            'Kasi Kesejahteraan',
            'Kasi Pelayanan',
            'Kepala Dusun'
        ];

        // Ambil semua 'media_id' yang ada (jika ada media)
        $mediaIds = DB::table('media')->pluck('media_id')->toArray();

        $data = [];

        for ($i = 0; $i < 100; $i++) {
            // Jika ada media, ambil acak. Jika kosong, null.
            $mediaId = !empty($mediaIds) ? $faker->randomElement($mediaIds) : null;

            $data[] = [
                // PERBAIKAN DI SINI:
                // Ambil satu ID secara acak dari daftar ID yang valid
                'warga_id'        => $faker->randomElement($wargaIds),

                'jabatan'         => $faker->randomElement($jabatanList),
                'nip'             => $faker->unique()->numerify('19##########00#'),
                'kontak'          => $faker->numerify('08##########'),
                'media_id'        => $mediaId,
                'periode_mulai'   => $faker->date('Y-m-d', '-5 years'),
                'periode_selesai' => $faker->optional(0.3)->date('Y-m-d', '+5 years'),
                'foto'            => 'dummy_foto_' . $i . '.jpg',
                'created_at'      => now(),
                'updated_at'      => now(),
            ];
        }

        DB::table('perangkat_desa')->insert($data);
    }
}
