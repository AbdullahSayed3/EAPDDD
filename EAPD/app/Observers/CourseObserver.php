<?php

namespace App\Observers;

use App\Models\ActivityLog;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class CourseObserver
{
    /**
     * Handle the Course "created" event.
     */
    // private $originalAttributes = [];

    public function created(Course $course): void
    {
        $course->load(['type', 'natural', 'organization.field', 'organization.natural']);

        $this->logAction($course, 'created', [
            'after' => $this->buildCourseLogData($course)
        ]);
    }

    public function updated(Course $course): void
    {
        $before = $course->getOriginal();
        $course->load(['type', 'natural', 'organization.field', 'organization.natural']);

        $this->logAction($course, 'updated', [
            'before' => $before,
            'after'  => $this->buildCourseLogData($course)
        ]);
    }

    public function deleted(Course $course): void
    {
        $course->load(['type', 'natural', 'organization.field', 'organization.natural']);

        $this->logAction($course, 'deleted', [
            'before' => $this->buildCourseLogData($course)
        ]);
    }

    /**
     * Handle the Course "restored" event.
     */
    public function restored(Course $course): void
    {
        //
    }

    /**
     * Handle the Course "force deleted" event.
     */
    public function forceDeleted(Course $course): void
    {
        //
    }

    protected function logAction($model, $action, $changes = null)
    {
        ActivityLog::create([
            'user_name'  => Auth::check() ? Auth::user()->name : null,
            'user_id'    => Auth::id(),
            'model_type' => get_class($model),
            'model_id'   => $model->id,
            'action'     => $action,
            'changes'    => $changes ? json_encode($changes) : null,
        ]);
    }

    protected function buildCourseLogData(Course $course): array
    {
        return array_merge(
            $course->getAttributes(),
            [
                'type' => $course->type?->only(['id', 'name_en', 'name_ar']),
                'natural' => $course->natural?->only(['id', 'name_en', 'name_ar']),
                'assessments' => $course->assessments,
                'applications' => $course->applications,
                'organization' => $course->organization ? array_merge(
                    $course->organization->only([
                        'id', 'name', 'address', 'contact_name', 'contact_email',
                        'documents', 'notes', 'field_id', 'partner_natural'
                    ]),
                    [
                        'field' => $course->organization->field?->only(['id', 'name_en', 'name_ar']),
                        'natural' => $course->organization->natural?->only(['id', 'name_en', 'name_ar']),
                        
                    ]
                ) : null
            ]
        );
    }
}
