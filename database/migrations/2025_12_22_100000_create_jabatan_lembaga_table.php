<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jabatan_lembaga', function (Blueprint $table) {
            $table->id('jabatan_id'); // Sesuaikan dengan referensi di anggota_lembagas
            $table->foreignId('lembaga_id')->constrained('lembaga_desa', 'lembaga_id')->onDelete('cascade');
            $table->string('nama_jabatan');
            $table->integer('level');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jabatan_lembaga');
    }
};
