<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;


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
