<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobType extends Model
{
    //
    protected $fillable = [
        'name_en',
        'name_ar',
        'name_fr',
    ];
    protected $casts = [
        'name_en' => 'string',
        'name_ar' => 'string',
        'name_fr' => 'string',
    ];
    public function jobs()
    {
        return $this->hasMany(Job::class, 'job_type_id');
    }
}
