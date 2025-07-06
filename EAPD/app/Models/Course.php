<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\App;

class Course extends Model
{
    protected $fillable = [
        'name_ar',
        'name_en',
        'name_fr',
        'type_id',
        'natural_id',
        'field_id',
        'content',
        'content_en',
        'content_fr',
        'start_date',
        'end_date',
        'location',
        'organization_id',
        'image',
        'images',
        'place_id',
        'documents',
        'countries',
        'trainees',
        'cost',
        'notes',
        'is_active',
        'benefit_ar',
        'requirement_ar',
        'benefit_en',
        'requirement_en',
        'benefit_fr',
        'requirement_fr'
    ];

    // protected $casts = [
    //     'images' => 'array',
    // ];

    public static function getAtomicClass()
    {
        return 'icon-book-open';
    }

    public static function label()
    {
        return awtTrans('الدورات التدريبية');
    }

    //    public static function subMenus()
    //    {
    //        return [
    //            awtTrans('الدورات التدريبية') => route('AtomicPanel.AtomicModelIndex', ['Course']),
    //            awtTrans('إضافة دورة تدريبية') => '#',
    //            awtTrans("الدول المدعوه") => '#',
    //            awtTrans("مراكز التميز والشركاء") => '#',
    //            awtTrans("التقييمات") => '#',
    //        ];
    //    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'start_date' => 'datetime',
            'end_date' => 'datetime',
        ];
    }

    public function name()
    {
        $locale = App::getLocale();
        $attr = 'name_' . $locale;

        return $this->$attr;
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(CourseType::class);
    }

    public function field(): BelongsTo
    {
        return $this->belongsTo(CourseField::class, 'field_id');
    }

    public function natural(): BelongsTo
    {
        return $this->belongsTo(CourseNatural::class, 'natural_id');
    }

    public function organization(): BelongsTo
    {
        return $this->belongsTo(CoursePartner::class, 'organization_id');
    }

    public function assessments(): HasMany
    {
        return $this->hasMany(Assessment::class, 'course_id');
    }

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class, 'course_id');
    }

    public function place()
    {
        return $this->belongsTo(Place::class, 'place_id');
    }

    public function scopeFilter($query, $params)
    {

        if (isset($params['type'])) {
            if ($params['type'] == 1) {
                $query->where('type_id', 'citizan');
            }

            if ($params['type'] == 2) {
                $query->where('type_id', 'police');
            }

            if ($params['type'] == 3) {
                $query->where('type_id', 'army');
            }
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
