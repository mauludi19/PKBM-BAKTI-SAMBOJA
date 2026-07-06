<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PpdbRegistration extends Model
{
    protected $fillable = [
        'academic_year_id',
        'package_id',
        'registration_type',

        'email',
        'full_name',
        'nisn',
        'nik',

        'birth_place',
        'birth_date',
        'gender',

        'last_education',

        'address',
        'phone',

        'father_name',
        'father_phone',

        'mother_name',
        'mother_phone',

        'family_card_file',
        'birth_certificate_file',
        'photo_file',
        'last_report_file',

        'status',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    /**
     * Relasi ke tahun ajaran.
     */
    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    /**
     * Relasi ke paket pendidikan.
     */
    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
