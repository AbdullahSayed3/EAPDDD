<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    //
    protected $fillable = [
        'name_en',
        'name_ar',
        'name_fr'
    ];
}
