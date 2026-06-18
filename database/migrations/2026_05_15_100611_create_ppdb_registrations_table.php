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

            $table->foreignId('academic_year_id')->constrained()->cascadeOnDelete();

            $table->foreignId('package_id')
                ->constrained('packages')
                ->cascadeOnDelete();

            $table->enum('registration_type', ['BOP', 'mandiri']);

            $table->string('email');

            $table->string('full_name');

            $table->string('nik', 20);

            $table->string('birth_place');

            $table->date('birth_date');

            $table->enum('gender', ['L', 'P']);

            $table->string('last_education');

            $table->text('address');

            $table->string('phone', 20);

            $table->string('father_name');
            $table->string('father_phone', 20)->nullable();

            $table->string('mother_name');
            $table->string('mother_phone', 20)->nullable();

            $table->string('family_card_file');
            $table->string('birth_certificate_file');
            $table->string('photo_file');
            $table->string('last_report_file');

            $table->enum('status', [
                'pending',
                'approved',
                'rejected'
            ])->default('pending');

            $table->timestamps();
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
