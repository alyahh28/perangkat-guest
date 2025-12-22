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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('media_id')->nullable()->after('email');

            // Tambahkan foreign key constraint
            $table->foreign('media_id')
                  ->references('media_id')
                  ->on('media')
                  ->onDelete('set null')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Hapus foreign key terlebih dahulu
            $table->dropForeign(['media_id']);

            // Hapus kolom
            $table->dropColumn('media_id');
        });
    }
};
