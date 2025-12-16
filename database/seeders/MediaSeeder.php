<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MediaSeeder extends Seeder
{
    public function run(): void
    {
        $data = [];

        // Kita buat pas 10 data agar ID-nya 1 sampai 10
        for ($i = 1; $i <= 10; $i++) {
            $data[] = [
                'media_id'    => $i, // Paksa ID urut 1-10
                'ref_table'   => 'seeder_awal', // Dummy saja
                'ref_id'      => 0,
                'file_name'   => 'dummy_image_' . $i . '.jpg',
                'caption'     => 'Foto Dummy ' . $i,
                'mime_type'   => 'image/jpeg',
                'sort_order'  => 0,
                'created_at'  => now(),
                'updated_at'  => now(),
            ];
        }

        DB::table('media')->insert($data);
    }
}
