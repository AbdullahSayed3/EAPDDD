<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Assessment extends Model
{
    protected $fillable = ['course_id', 'name', 'country', 'job', 'assessment'];

    public function course(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Course::class, 'course_id');
    }
}
