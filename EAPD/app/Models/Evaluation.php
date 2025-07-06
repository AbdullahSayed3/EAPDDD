<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    //
    protected $fillable = [
        'question',
        'is_mcq',
        'answers'
    ];

    protected $casts = [
        'answers'=>'array' // if is_mcq is true
    ];

}
