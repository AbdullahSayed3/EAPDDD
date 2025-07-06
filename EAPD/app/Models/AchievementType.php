<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AchievementType extends Model
{
    //
    protected $fillable = [
        'id',
        'name_ar',
        'name_en',
        'name_fr',
    ];

    public function achievements()
    {
        return $this->hasMany(Achievement::class, 'achievement_type_id');
    }
}
