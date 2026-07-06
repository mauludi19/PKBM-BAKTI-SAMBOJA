<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Package extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function ppdbRegistrations()
    {
        return $this->hasMany(PpdbRegistration::class);
    }
}
