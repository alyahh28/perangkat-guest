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
            // Menambahkan kolom username setelah email
            $table->string('username')->unique()->nullable()->after('email');

            // Menambahkan kolom role setelah password (jika belum ada)
            // Jika kolom role sudah ada sebelumnya, hapus baris di bawah ini
            $table->string('role')->default('User')->after('password');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['username', 'role']);
        });
    }
};
