<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'featured_image',
        'content',
        'featured',
    ];

    protected $casts = [
        'featured' => 'boolean',
    ];
}
