<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        'code',
        'name',
    ];

    public function tutors()
    {
        return $this->belongsToMany(Tutor::class, 'tutor_subjects');
    }

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }
}
