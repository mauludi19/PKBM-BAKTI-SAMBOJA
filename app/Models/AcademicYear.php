<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model
{
    protected $fillable = [
        'year',
        'is_active',
    ];

    public function ppdbRegistrations()
    {
        return $this->hasMany(PpdbRegistration::class);
    }
}