<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    //
    protected $fillable = [
        'name_ar',
        'name_en',
        'name_fr',
        'code',
        'lat',
        'lng'
    ];

    public function application()
    {
        return $this->hasMany(Application::class, 'nationality', 'code');
    }

    public function maleApplications()
    {
        return $this->application()->where('gender', 'male');
    }

    public function femaleApplications()
    {
        return $this->application()->where('gender', 'female');
    }
}
