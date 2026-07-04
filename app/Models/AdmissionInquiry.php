<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdmissionInquiry extends Model
{
    protected $fillable = [
        'student_name',
        'dob',
        'gender',
        'parent_name',
        'phone',
        'email',
        'grade',
        'previous_school',
        'message',
    ];

    protected $casts = [
        'dob' => 'date',
    ];
}
