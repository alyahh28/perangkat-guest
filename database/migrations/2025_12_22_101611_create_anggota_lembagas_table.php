<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('anggota_lembagas', function (Blueprint $table) {
            $table->id('anggota_id');
            
            $table->foreignId('lembaga_id')->constrained('lembaga_desa', 'lembaga_id')->onDelete('cascade');
            $table->foreignId('warga_id')->constrained('warga', 'warga_id')->onDelete('cascade');
            $table->foreignId('jabatan_id')->constrained('jabatan_lembaga', 'jabatan_id')->onDelete('cascade');

            $table->date('tgl_mulai');
            $table->date('tgl_selesai')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('anggota_lembagas');
    }
};
