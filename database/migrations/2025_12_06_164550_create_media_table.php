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
        Schema::create('media', function (Blueprint $table) {
            $table->id('media_id'); // Primary key dengan nama custom
            $table->string('ref_table', 100); // Nama tabel yang direferensikan
            $table->unsignedBigInteger('ref_id'); // ID dari tabel yang direferensikan
            $table->string('file_name'); // Nama file
            $table->text('caption')->nullable(); // Caption/keterangan gambar
            $table->string('mime_type'); // Tipe MIME file
            $table->integer('sort_order')->default(0); // Urutan tampil

            // Index untuk performa query
            $table->index(['ref_table', 'ref_id']);
            $table->index('sort_order');

            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
