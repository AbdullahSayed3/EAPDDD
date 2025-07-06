<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    //
    protected $fillable = [
        'title',
        'image',
        'content',
        'cover',
        'is_active',
        'code'
    ];

    public function images()
    {
        return $this->hasMany(BlogImage::class,'blog_id');
    }

     public function scopeFilter($query, $params)
     {  
         if (isset($params['q'])) {
            $word = $params['q'];
                $query->where(function ($q) use ($word) {
                    $q->where('title', 'LIKE', '%' . $word . '%');
                });
        }
          return $query;
    }
}
