<?php

namespace App\Observers;

use App\Models\ActivityLog;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;

class ApplicationObserver
{
    /**
     * Handle the Application "created" event.
     */
      public function created(Application $application): void
    {
        $application->load([
            'course.type',
            'course.natural',
            'course.organization',
            'course.field'
        ]);

        $this->logAction($application, 'created', [
            'after' => $this->buildApplicationLogData($application)
        ]);
    }

    public function updated(Application $application): void
    {
        $before = $application->getOriginal();

        $application->load([
            'course.type',
            'course.natural',
            'course.organization',
            'course.field'
        ]);

        $this->logAction($application, 'updated', [
            'before' => $before,
            'after' => $this->buildApplicationLogData($application)
        ]);
    }

    public function deleted(Application $application): void
    {
        $application->load([
            'course.type',
            'course.natural',
            'course.organization',
            'course.field'
        ]);

        $this->logAction($application, 'deleted', [
            'before' => $this->buildApplicationLogData($application)
        ]);
    }

    protected function buildApplicationLogData(Application $application): array
    {
        return array_merge(
            $application->getAttributes(),
            [
                'course' => $application->course ? array_merge(
                    $application->course->toArray(),
                    [
                        'type' => $application->course->type?->only(['id', 'name_en', 'name_ar']),
                        'natural' => $application->course->natural?->only(['id', 'name_en', 'name_ar']),
                        'organization' => $application->course->organization?->only(['id', 'name', 'address', 'contact_name', 'contact_email']),
                        'field' => $application->course->field?->only(['id', 'name_en', 'name_ar']),
                        'assessments' => $application->course->assessments,
                        'applications' => $application->course->applications,
               
                    ],
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
