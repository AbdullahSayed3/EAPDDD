<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TrialTeral extends Model
{
    //
    protected $fillable = [
        'name',
        'contract_files',
        'contract_field',
        'cost',
        'agency_cost',
        'details',
        'start_date',
        'status',
        'acceptation_number',
        'notes',
        'beneficiary_countries',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'datetime',
        ];
    }

    public function field(): BelongsTo
    {
        return $this->belongsTo(\App\Models\TrialTeralField::class, 'contract_field');
    }
}
