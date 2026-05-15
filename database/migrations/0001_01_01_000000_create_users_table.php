<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            // Primary Key
            $table->id();

            // Nama lengkap pengguna
            $table->string('name');

            // Email untuk login
            $table->string('email')->unique();

            // Email verification (opsional, bawaan Laravel)
            $table->timestamp('email_verified_at')->nullable();

            // Password terenkripsi
            $table->string('password');

            // Role pengguna
            // admin   = pengelola sistem
            // tutor   = pengajar
            // student = siswa
            $table->enum('role', ['admin', 'tutor', 'student'])
                ->default('student');

            // Token "remember me"
            $table->rememberToken();

            // Timestamps
            $table->timestamps();
        });

        // Tabel reset password (bawaan Laravel)
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        // Tabel session (bawaan Laravel jika menggunakan database session)
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Rollback migration.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
};
