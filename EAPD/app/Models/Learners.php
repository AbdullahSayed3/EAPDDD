<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Learners extends Model
{
    protected $fillable = [
        'scholarships_id',
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'nationality',
        'email_address',
        'birth_date',
        // 'address',
        // 'phone_number',
        // 'personal_picture',
        // 'passport_id',
        // 'passport_photos',
        // 'qualification',
        // 'qualification_certificates',
        // 'languages',
        // 'country',
        // 'current_employer',
        // 'employer_address',
        // 'employer_phone',
        // 'employer_email',
        // 'cv_file',
        // 'health_certificates',
        // 'other_certificates',
        // 'trainee_status',
        // 'wait_list',
        // 'created_at',

    ];
    protected $guarded=[
        'id',
        // 'middle_name',
        // 'last_name',
    ];

    protected function casts(): array
    {
        return [
            'birth_date' => 'datetime',
        ];
    }
    //

    //    public function setBirthDateAttribute($value)
    //    {
    //        dd(Carbon::createFromTimeString($value));
    //        $this->attributes['birth_date'] =Carbon::createFromTimeString($value)->toDateTimeString();
    //    }

    public function scholarship(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Scholarships::class, 'scholarships_id');
    }

    public function name()
    {
        $model = $this;
        $name = $model->first_name.' '.$model->middle_name.' '.$model->last_name;

        return $name;

    }

    public function age()
    {
        $model = $this;
        $birth_date = Carbon::parse($model->birth_date);
        $now = Carbon::now();
        $age = $birth_date->diff($now)->format('%y');
        // $age = Carbon::createFromTimeString($model->birth_date)->diff(Carbon::now())->format('%y');

        return $age;

    }
}
