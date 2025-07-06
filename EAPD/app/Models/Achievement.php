<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    //
    protected $fillable = [
        'id',
        'name_ar',
        'name_en',
        'name_fr',
        'description_ar',
        'description_en',
        'description_fr',
        'achievement_type_id',
        'image',
        'is_active',
        'country_id'
    ];

    public function achievementType()
    {
        return $this->belongsTo(AchievementType::class, 'achievement_type_id');
    }

      public function scopeFilter($query, $params)
      {  
            
          if(isset($params['type']))
          {
              $query->where('achievement_type_id',$params['type']);
          }  
          return $query;
      }
}
