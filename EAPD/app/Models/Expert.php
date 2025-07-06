<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expert extends Model
{
    //
    protected $fillable = [
        'name',
        'country',
        'specialist',
        'sub_specialist',
        'qualification',
        'certifications',
        'gender',
        'personal_picture',
        'passport_number',
        'passport_photos',
        'languages',
        'current_employer',
        'employer_address',
        'employer_phone',
        'employer_email',
        'old_contracts',
        'cv',
        'phone',
        'email',
        'status',
        'contract_rules',
        'delegate_country',
        'delegate_org',
        'contract_date',
        'end_date',
        'acceptation_info',
        'cost',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'contract_date' => 'datetime',
            'end_date' => 'datetime',
        ];
    }
}
