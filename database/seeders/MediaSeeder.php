<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MediaSeeder extends Seeder
{
    public function run(): void
    {
        $data = [];

        // Buat 20 data dummy
        for ($i = 1; $i <= 20; $i++) {
            $data[] = [
                'media_id'    => $i,
                'ref_table'   => 'seeder_awal', 
                'ref_id'      => 0,
                'file_name'   => 'dummy_image_' . $i . '.jpg',
                'caption'     => 'Foto Dummy ' . $i,
                'mime_type'   => 'image/jpeg',
                'sort_order'  => 0,
                'created_at'  => now(),
                'updated_at'  => now(),
            ];
        }

        DB::table('media')->insertOrIgnore($data); // Pakai insertOrIgnore biar aman kalau run ulang
    }
}
