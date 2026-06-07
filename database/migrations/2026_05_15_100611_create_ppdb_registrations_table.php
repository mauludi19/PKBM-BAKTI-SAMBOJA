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
        Schema::create('ppdb_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone', 20);
            $table->text('address');

            // Relasi ke Paket & Tahun Ajaran
            $table->foreignId('package_id')->constrained('packages')->onDelete('cascade');
            $table->foreignId('academic_year_id')->constrained('academic_years')->onDelete('cascade');

            // Tambahan Kolom Baru Sesuai Request Abet
            $table->string('nik', 16)->unique();
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('pendidikan_terakhir');

            // Data Orang Tua
            $table->string('nama_ayah');
            $table->string('phone_ayah', 20)->nullable();
            $table->string('nama_ibu');
            $table->string('phone_ibu', 20)->nullable();

            // Upload Dokumen Berkas (Menyimpan nama/path file)
            $table->string('scan_kk')->nullable();
            $table->string('scan_akta')->nullable();
            $table->string('pasfoto')->nullable();
            $table->string('scan_rapor')->nullable();

            // Status & Catatan Kelulusan
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
            $table->text('notes')->nullable();

            $table->timestamps();

            // Indexing untuk optimasi query pembacaan data admin
            $table->index('status');
            $table->index('academic_year_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppdb_registrations');
    }
};
