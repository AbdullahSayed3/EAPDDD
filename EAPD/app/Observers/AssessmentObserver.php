<?php

namespace App\Observers;

use App\Models\ActivityLog;
use App\Models\Assessment;
use Illuminate\Support\Facades\Auth;

class AssessmentObserver
{
   public function created(Assessment $assessment): void
    {
        $assessment->load([
            'course.type',
            'course.natural',
            'course.organization',
            'course.field'
        ]);

        $this->logAction($assessment, 'created', [
            'after' => $this->buildAssessmentLogData($assessment)
        ]);
    }

    public function updated(Assessment $assessment): void
    {
        $before = $assessment->getOriginal();

        $assessment->load([
            'course.type',
            'course.natural',
            'course.organization',
            'course.field'
        ]);

        $this->logAction($assessment, 'updated', [
            'before' => $before,
            'after' => $this->buildAssessmentLogData($assessment)
        ]);
    }

    public function deleted(Assessment $assessment): void
    {
        $assessment->load([
            'course.type',
            'course.natural',
            'course.organization',
            'course.field'
        ]);

        $this->logAction($assessment, 'deleted', [
            'before' => $this->buildAssessmentLogData($assessment)
        ]);
    }

    protected function buildAssessmentLogData(Assessment $assessment): array
    {
        return array_merge(
            $assessment->getAttributes(),
            [
                'course' => $assessment->course ? array_merge(
                    $assessment->course,
                    [
                        'type' => $assessment->course->type?->only(['id', 'name_en', 'name_ar']),
                        'natural' => $assessment->course->natural?->only(['id', 'name_en', 'name_ar']),
                        'organization' => $assessment->course->organization?->only(['id', 'name', 'address', 'contact_name', 'contact_email']),
                        'field' => $assessment->course->field?->only(['id', 'name_en', 'name_ar']),
                        'applications' => $assessment->course->applications,
                    ]
                ) : null
            ]
        );
    }

    protected function logAction($model, $action, $changes = null): void
    {
        ActivityLog::create([
            'user_name' => Auth::check() ? Auth::user()->name : null,
            'user_id' => Auth::id(),
            'model_type' => get_class($model),
            'model_id' => $model->id,
            'action' => $action,
            'changes' => $changes ? json_encode($changes) : null,
        ]);
    }
}
