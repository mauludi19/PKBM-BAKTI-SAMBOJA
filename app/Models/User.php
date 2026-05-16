<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Kolom yang boleh diisi secara mass assignment.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * Kolom yang disembunyikan saat model diubah ke array/JSON.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Relasi ke tabel students.
     * Satu user (role student) memiliki satu data student.
     */
    public function student()
    {
        return $this->hasOne(Student::class);
    }

    /**
     * Relasi ke tabel tutors.
     * Satu user (role tutor) memiliki satu data tutor.
     */
    public function tutor()
    {
        return $this->hasOne(Tutor::class);
    }

    /**
     * Relasi ke tabel news.
     * Satu user dapat membuat banyak berita.
     */
    public function news()
    {
        return $this->hasMany(News::class, 'author_id');
    }

    /**
     * Cast atribut.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}