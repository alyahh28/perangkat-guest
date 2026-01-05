<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class AnggotaLembagaSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Ambil ID Lembaga (PK: lembaga_id)
        $lembagaIds = DB::table('lembaga_desa')->pluck('lembaga_id')->toArray();
        // Ambil ID Jabatan (PK: jabatan_id)
        $jabatanIds = DB::table('jabatan_lembaga')->pluck('jabatan_id')->toArray();

        if (empty($lembagaIds) || empty($jabatanIds)) {
            $this->command->info('Harap isi data LembagaDesa dan JabatanLembaga terlebih dahulu!');
            return;
        }

        $data = [];



        // Namun, agar lebih valid relasinya (Jabatan X memang ada di Lembaga Y), 
        // sebaiknya kita iterasi Jabatan saja, karena Jabatan sudah terikat Lembaga.
        // Tapi Anggota Lembaga mencatat 'lembaga_desa_id' dan 'jabatan_lembaga_id' secara terpisah?
        // Mari cek struktur tabel (saya tidak bisa lihat migrasi anggota lagi sekarang, tapi asumsi ada 2 FK).
        // Jika ada 2 FK, risiko inkonsistensi. 
        // Solusi: Ambil Jabatan, lalu ambil lembaga_id-nya.
        
        $dataValid = [];
        // Ambil semua jabatan beserta lembaga_id-nya
        $jabatanList = DB::table('jabatan_lembaga')->select('jabatan_id', 'lembaga_id')->get();

        $wargaIds = DB::table('warga')->pluck('warga_id')->toArray();

        if ($jabatanList->isEmpty() || empty($wargaIds)) {
             $this->command->info('Data Jabatan atau Warga kosong.');
             return;
        }

        for ($i = 1; $i <= 50; $i++) {
            $jabatan = $jabatanList->random();
            
            $dataValid[] = [
                'lembaga_id' => $jabatan->lembaga_id, // Match lembaga from jabatan
                'jabatan_id' => $jabatan->jabatan_id,
                'warga_id' => $faker->randomElement($wargaIds),
                'tgl_mulai' => $faker->date(),
                'tgl_selesai' => $faker->optional(0.3)->date(), // 30% chance of having end date
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('anggota_lembagas')->insert($dataValid);
    }
}
