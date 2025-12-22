<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rts', function (Blueprint $table) {
            $table->id();
            // Menghubungkan ke tabel rws
            $table->foreignId('rw_id')->constrained('rws')->onDelete('cascade');
            $table->string('no_rt', 5); // Contoh: 001, 002
            $table->string('ketua_rt');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rts');
    }
};
