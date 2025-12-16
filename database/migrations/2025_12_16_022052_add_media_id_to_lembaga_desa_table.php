<?php
// database/migrations/2025_12_08_014535_add_media_id_to_lembaga_desa_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
       Schema::table('lembaga_desa', function (Blueprint $table) {
    $table->foreignId('media_id')
          ->nullable()
          ->after('kontak')
          ->constrained('media', 'media_id')
          ->onDelete('set null');
});
    }

    public function down(): void
    {
        Schema::table('lembaga_desa', function (Blueprint $table) {
            // Hapus foreign key dan kolom media_id
            $table->dropForeign(['media_id']);
            $table->dropColumn('media_id');
        });
    }
};
