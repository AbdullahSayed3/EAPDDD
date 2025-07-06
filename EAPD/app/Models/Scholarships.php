<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Scholarships extends Model
{
    //
    use SoftDeletes;

    //
    protected $fillable = [
        'program',
        'program_en',
        'program_fr',
        'is_active',
        'content_en',
        'content_fr',
        'content_ar',
        'owner',
        'department',
        'start_date',
        'end_date',
        'learners_num',
        'image',
        'annual_cost',
        'participants',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'datetime',
            'end_date' => 'datetime',
        ];
    }

    public function field(): BelongsTo
    {
        return $this->belongsTo(\App\Models\CourseField::class, 'department');
    }

    public function learners(): HasMany
    {
        return $this->hasMany(\App\Models\Learners::class, 'scholarships_id');
    }

    public function scopeFilter($query, $params)
     {  
         if (isset($params['q'])) {
            $word = $params['q'];
                $query->where(function ($q) use ($word) {
                    $q->where('program', 'LIKE', '%' . $word . '%')
                      ->orWhere('program_en', 'LIKE', '%' . $word . '%')
                      ->orWhere('program_fr', 'LIKE', '%' . $word . '%');
                });
        }    
        if (isset($params['country'])) {
            $query->where('participants', 'like', '%"' . $params['country'] . '"%');
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
