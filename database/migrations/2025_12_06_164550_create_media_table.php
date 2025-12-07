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

            $table->id('media_id'); // Primary key dengan nama media_id


            $table->string('ref_table', 50)->comment('Nama tabel referensi');  // Kolom untuk mereferensikan tabel lain


            $table->unsignedBigInteger('ref_id')->comment('ID baris dari tabel referensi');  // Kolom untuk ID dari baris di tabel lain. Gunakan unsignedBigInteger.


            $table->string('file_name')->comment('Nama file media yang disimpan'); // Nama file yang disimpan (harus ada)


            $table->string('caption')->nullable()->comment('Keterangan atau deskripsi media');  // Keterangan atau deskripsi (opsional, bisa nullable)


            $table->string('mime_type', 100)->comment('Tipe MIME file (misalnya: image/jpeg)');  // Tipe MIME file (harus ada)


            $table->integer('sort_order')->nullable()->comment('Urutan tampilan media');  // Urutan tampilan (opsional, bisa nullable)

            $table->timestamps();


            $table->index(['ref_table', 'ref_id']);   // Menambahkan index untuk pencarian cepat berdasarkan ref_table dan ref_id
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
