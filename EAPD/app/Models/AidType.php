<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AidType extends Model
{
    protected $fillable = [
        'name_ar',
        'name_en',
        'image',
        'parent_id'
    ];

    public function parent()
    {
        return $this->belongsTo(AidType::class, 'parent_id');
    }
}
