<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CoursePartner extends Model
{
    //
    protected $table = 'course_partners';
    protected $fillable = [
        'name',
        'name_en',
        'name_fr',
        'field_id',
        'partner_natural',
        'contact_name',
        'address',
        'address_en',
        'address_fr',
        'contact_phone',
        'contact_email',
        'documents',
        'notes',

    ];

    public function courses(): HasMany
    {
        return $this->hasMany(\App\Models\Course::class, 'organization_id');
    }

    public function field(): BelongsTo
    {
        return $this->belongsTo(\App\Models\CourseField::class, 'field_id');
    }

    public function natural(): BelongsTo
    {
        return $this->belongsTo(\App\Models\CourseNatural::class, 'partner_natural');

    }
}
