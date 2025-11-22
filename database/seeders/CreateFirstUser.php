<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CreateFirstUser extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // HANYA MENGISI KOLOM YANG ADA DI FILE MIGRASI users TABLE
        User::create([
            'name' => 'Guestt Desa',
            'email' => 'guestt@desa.com',
            'password' => Hash::make('guestt123'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => 'Operatorr Desaa',
            'email' => 'operatorr@desaa.com',
            'password' => Hash::make('operatorr1234'),
            'remember_token' => Str::random(10),
        ]);
    }
}
