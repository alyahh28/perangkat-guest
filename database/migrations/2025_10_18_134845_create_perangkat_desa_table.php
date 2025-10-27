<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('perangkat_desa', function (Blueprint $table) {
            $table->id('perangkat_id');
            $table->foreignId('warga_id')->constrained('warga', 'warga_id')->onDelete('cascade');
            $table->string('jabatan', 100);
            $table->string('nip', 20)->nullable();
            $table->string('kontak', 15);
            $table->date('periode_mulai');
            $table->date('periode_selesai')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('perangkat_desa');
    }
};
