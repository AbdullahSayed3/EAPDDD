<?php

namespace App\Observers;

use App\Models\ActivityLog;
use App\Models\Scholarships;
use Illuminate\Support\Facades\Auth;

class ScholarshipsObserver
{
   public function created(Scholarships $scholarship): void
    {
        $this->logAction($scholarship, 'created', ['after'=>$this->buildEventLogData($scholarship)]);
    }

    public function updated(Scholarships $scholarship): void
    {
        $this->logAction($scholarship, 'updated', ['before'=>$scholarship->getOriginal(),'after'=>$this->buildEventLogData($scholarship)]);
    }

    public function deleted(Scholarships $scholarship): void
    {
        $this->logAction($scholarship, 'deleted',['before'=> $this->buildEventLogData($scholarship)]);
    }

    public function restored(Scholarships $scholarship): void
    {
        $this->logAction($scholarship, 'restored', $this->buildEventLogData($scholarship));
    }

    public function forceDeleted(Scholarships $scholarship): void
    {
        $this->logAction($scholarship, 'force_deleted', $this->buildEventLogData($scholarship));
    }

    protected function buildEventLogData(Scholarships $scholarship): array
    {
        $scholarship->load('field');

        return array_merge(
            $scholarship->getAttributes(),
            [
                'field' => $scholarship->field ? $scholarship->field->only(['id', 'name_en', 'name_ar']) : null,
                'learners' => $scholarship->learners,
                'learners_count' => $scholarship->learners()->count(),
            ]
        );
    }

    protected function logAction(Scholarships $model, string $action, array $changes): void
    {
        ActivityLog::create([
            'user_name'  => Auth::check() ? Auth::user()->name : null,
            'user_id'    => Auth::id(),
            'model_type' => get_class($model),
            'model_id'   => $model->id,
            'action'     => $action,
            'changes'    => json_encode($changes),
        ]);
    }
}
