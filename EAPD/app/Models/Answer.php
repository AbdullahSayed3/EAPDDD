<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    //
    protected $fillable = [
        'evaluation_id',
        'course_id',
        'applicant_id',
        'answer'
    ];

    public function course(){
        return $this->belongsTo(Course::class,'course_id');
    }

    public function evaluation(){
        return $this->belongsTo(Evaluation::class,'evaluation_id');
    }

    
    public function application(){
        return $this->belongsTo(Application::class,'applicant_id');
    }
}
