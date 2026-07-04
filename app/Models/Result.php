<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = [
        'title',
        'exam_name',
        'grade',
        'academic_year',
        'result_date',
        'description',
        'file',
        'external_url',
        'is_published',
    ];

    protected $casts = [
        'result_date' => 'date',
        'is_published' => 'boolean',
    ];
}
