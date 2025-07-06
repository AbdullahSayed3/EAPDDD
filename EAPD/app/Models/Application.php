<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\NewAccessToken;

class Application extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'course_id',
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'nationality',
        'address',
        'phone_number',
        'email_address',
        'password',
        'birth_date',
        'personal_picture',
        'passport_id',
        'passport_photos',
        'qualification',
        'qualification_certificates',
        'languages',
        'country',
        'current_employer',
        'employer_address',
        'employer_phone',
        'employer_email',
        'cv_file',
        'health_certificates',
        'other_certificates',
        'trainee_status',
        'wait_list',
        'created_at',

    ];

    protected function casts(): array
    {
        return [
            'birth_date' => 'datetime',
        ];
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
    //

    //    public function setBirthDateAttribute($value)
    //    {
    //        dd(Carbon::createFromTimeString($value));
    //        $this->attributes['birth_date'] =Carbon::createFromTimeString($value)->toDateTimeString();
    //    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Course::class, 'course_id');
    }

    public function name()
    {
        $model = $this;
        $name = $model->first_name.' '.$model->middle_name.' '.$model->last_name;

        return $name;

    }


      public function createToken(string $name, array $abilities = ['*'])
    {
        $token = $this->tokens()->create([
            'name' => $name,
            'token' => hash('sha256', $plainTextToken = Str::random(400)),
            'abilities' => $abilities,
        ]);
        return new NewAccessToken($token, $token->getKey().'|'.$plainTextToken);
    }
}
