<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FAQ extends Model
{
    //
    protected $fillable = ['question', 'answer','code','is_active'];
    protected $table = 'faqs';

}
