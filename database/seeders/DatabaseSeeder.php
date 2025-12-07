<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\JabatanSeeder;
use Database\Seeders\LembagaSeeder;
use Database\Seeders\PerangkatSeeder;
use Database\Seeders\WargaSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->call([
            WargaSeeder::class,
            LembagaDesaSeeder::class,
            PerangkatDesaSeeder::class,
            JabatanLembagaSeeder::class,

    ]);

    }
}
