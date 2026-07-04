<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    protected $fillable = [
        'name',
        'photo',
        'photo_position_x',
        'photo_position_y',
        'photo_zoom',
        'designation',
        'qualification',
        'department',
    ];

    protected $casts = [
        'photo_position_x' => 'integer',
        'photo_position_y' => 'integer',
        'photo_zoom' => 'integer',
    ];
}
