<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    //
    protected $fillable = [
        'user_id',
        'user_name',
        'model_type',
        'model_id',
        'action',
        'changes',
        'ip-address',
        'user_agent',
        'created_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
