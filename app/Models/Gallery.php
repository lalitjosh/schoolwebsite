<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = [
        'title',
        'cover_image',
        'description',
    ];

    public function images(): HasMany
    {
        return $this->hasMany(GalleryImage::class);
    }
}
