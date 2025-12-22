<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('anggota_lembagas', function (Blueprint $table) {
            $table->id(); // Ini id milik tabel anggota sendiri (biarkan default)

            // 1. Relasi ke Lembaga Desa (Target: lembaga_id)
            $table->unsignedBigInteger('lembaga_desa_id');
            $table->foreign('lembaga_desa_id')
                  ->references('lembaga_id') // <--- PERBAIKAN: Arahkan ke lembaga_id
                  ->on('lembaga_desa')
                  ->onDelete('cascade');

            // 2. Relasi ke Jabatan Lembaga (Target: jabatan_id)
            $table->unsignedBigInteger('jabatan_lembaga_id');
            $table->foreign('jabatan_lembaga_id')
                  ->references('jabatan_id') // <--- PERBAIKAN: Arahkan ke jabatan_id
                  ->on('jabatan_lembaga')
                  ->onDelete('cascade');

            $table->string('nama');
            $table->string('nomor_anggota')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('anggota_lembagas');
    }
};
