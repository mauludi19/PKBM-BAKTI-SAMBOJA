<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nip',
        'gender',
        'education',
        'specialization',
        'phone',
        'address',
        'photo'
    ];

    public function subjects() 
    {
        return $this->belongsToMany(subject::class, 'tutor_subjects');
    }

    public function grades()
    {
        return $this->belongsToMany(grade::class, 'tutor_grades');
    }
}
