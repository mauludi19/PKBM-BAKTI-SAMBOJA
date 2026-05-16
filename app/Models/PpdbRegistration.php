<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PpdbRegistration extends Model
{
    protected $fillable = [
        'academic_year_id',
        'package_id',
        'registration_type',
        'full_name',
        'nik',
        'nisn',
        'gender',
        'birth_place',
        'birth_date',
        'address',
        'phone',
        'parent_name',
        'previous_school',
        'status',
    ];

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}