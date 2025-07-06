<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    //
    protected $fillable = [
        'name_ar',
        'name_en',
        'name_fr',

        'job_ar',
        'job_en',
        'job_fr',

        'image',
        'is_active',
        'is_main',
    ];
    protected $casts = [
        'is_active' => 'boolean',
        'is_main' => 'boolean',
    ];

}
