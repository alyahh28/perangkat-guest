<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('lembaga_desa', function (Blueprint $table) {
            $table->id('lembaga_id');
            $table->string('nama_lembaga', 100);
            $table->text('deskripsi')->nullable();
            $table->string('kontak', 50)->nullable();
            $table->string('logo', 255)->nullable(); // Tetap simpan untuk backward compatibility
            $table->timestamps();

            // Foreign key ke media (untuk multiple foto)
            // $table->foreignId('media_id')->nullable()->constrained('media')->onDelete('set null'); // HAPUS BARIS INI
        });
    }

    public function down()
    {
        Schema::dropIfExists('lembaga_desa');
    }
};
