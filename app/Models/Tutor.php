<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    protected $fillable = [
        'user_id',
        'nip',
        'gender',
        'education',
        'specialization',
        'phone',
        'address',
        'photo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'tutor_subjects');
    }

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }
}