<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'thumbnail',
        'content',
        'published_at',
        'author_id',
        'is_published',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
