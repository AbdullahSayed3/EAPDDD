<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Aid extends Model
{
    protected $fillable = [
        'title_en',
        'title_ar',
        'title_fr',
        'description_en',
        'description_ar',
        'description_fr',
        'image',
        'file',
        'url',
        'contact',
        'is_active',
        'suppliers',
        'type_id',
        'country_id',
        'country_org',
        'minister_name',
        'ship_date',
        'arrive_date',
        'cost',
        'notes',
        'type'
    ];

    protected function casts(): array
    {
        return [
            'ship_date' => 'datetime',
            'arrive_date' => 'datetime',
        ];
    }
    //

    public function type(): BelongsTo
    {
        return $this->belongsTo(\App\Models\AidType::class, 'type_id');
    }

    public function scopeAid($query)
    {
        $query->where('type', 'aids');
    }

    public function scopeCravan($query)
    {
        $query->where('type', 'cravan');
    }

    public function getSupp()
    {
        $suppliers = unserialize($this->suppliers);
        $supplier = $suppliers[0];
        $get_supplier = AidSupplier::where('id', $supplier['id'])->first();
        if (empty($get_supplier)) {
            return 'N/A';
        }

        return $get_supplier->name;
    }

    public function scopeFilter($query, $params)
    {

        if (isset($params['type'])) {
            $query->where('type_id', $params['type']);
        }

        if (isset($params['country'])) {
            $query->where('country_id', $params['country']);
        }
        if (isset($params['q'])) {
            $word = $params['q'];
            $query->where(function ($q) use ($word) {
                $q->where('name', 'LIKE', '%' . $word . '%')
                    ->orWhere('name_fr',  'LIKE', '%' . $word . '%')
                    ->orWhere('name_en', 'LIKE', '%' . $word . '%');
            });
        }
        return $query;
    }
}
