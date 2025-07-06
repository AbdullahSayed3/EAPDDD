<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Events extends Model
{
    use SoftDeletes;

    //
    protected $fillable = [
        'type_id',
        'subject',
        'participants',
        'start_date',
        'end_date',
        'location',
        'documents',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'datetime',
            'end_date' => 'datetime',
        ];
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(\App\Models\EventType::class,'type_id');
    }

    public function organizations()
    {
        $array = unserialize($this->participants);

        return implode('-', $array);
    }
}
