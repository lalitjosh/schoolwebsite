<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'school_name',
        'tagline',
        'established_year',
        'logo',
        'favicon',
        'phone',
        'email',
        'address',
        'map_embed_url',
        'map_external_url',
        'facebook',
        'instagram',
        'youtube',
        'footer_about',
        'footer_credit',
    ];
}
