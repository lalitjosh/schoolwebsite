<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageContent extends Model
{
    protected $fillable = [
        'key',
        'page',
        'section',
        'eyebrow',
        'title',
        'subtitle',
        'body',
        'items',
        'image',
        'button_label',
        'button_url',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'items' => 'array',
        'is_active' => 'boolean',
    ];
}
