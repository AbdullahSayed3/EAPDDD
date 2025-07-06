<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    //
    protected $fillable = [
        'name',
        'image',
        'content',
        'country_id',
        'job_type_id',
        'tags',
        'start_date',
        'end_date',
        'requirements',
        'benefit',
        'is_active',
        'code'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'tags' => 'array',

        'country_id' => 'array',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function images()
    {
        return $this->hasMany(jobImage::class,'job_id');
    }

    public function jobType()
    {
        return $this->belongsTo(JobType::class, 'job_type_id');
    }

    public function scopeFilter($query, $params)
     {  
         if (isset($params['q'])) {
            $word = $params['q'];
                $query->where(function ($q) use ($word) {
                    $q->where('name', 'LIKE', '%' . $word . '%');
                });
        }    
        if (isset($params['country'])) {
            // $countries = is_array($params['country']) ? $params['country'] : [$params['country']];
            
            // $query->where(function($q) use ($countries) {
            //     foreach ($countries as $countryId) {
            //         $q->orWhere('country_id', 'like', '%"' . (int)$countryId . '"%');
            //     }
            // });
            $query->where('country_id', 'like', '%"' . $params['country'] . '"%');
        }
        if(isset($params['type'])) {
            $query->where('job_type_id', $params['type']);            
        }
        if (!empty($params['start_date'])) {
        $query->whereDate('start_date', '>=', $params['start_date']);
        }
    
        if (!empty($params['end_date'])) {
            $query->whereDate('start_date', '<=', $params['end_date']);
        }
        return $query;
    }

    

}
