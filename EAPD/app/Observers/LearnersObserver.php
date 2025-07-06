<?php

namespace App\Observers;

use App\Models\ActivityLog;
use App\Models\Learners;
use Illuminate\Support\Facades\Auth;

class LearnersObserver
{
    public function created(Learners $learners): void
    {
        $this->logAction($learners, 'created', [
            'after' => $this->buildEventLogData($learners)
        ]);
    }

    public function updated(Learners $learners): void
    {       
         $before = $learners->getOriginal();

        $this->logAction($learners, 'updated',[
            'before'=>$before,
            'after'=>$this->buildEventLogData($learners)
        ] );
    }

    public function deleted(Learners $learners): void
    {
        $this->logAction($learners, 'deleted', ['before'=>$this->buildEventLogData($learners)]);
    }

    public function restored(Learners $learners): void
    {
        $this->logAction($learners, 'restored', $this->buildEventLogData($learners));
    }

    public function forceDeleted(Learners $learners): void
    {
        $this->logAction($learners, 'force_deleted', $this->buildEventLogData($learners));
    }

    protected function buildEventLogData(Learners $learners): array
    {
        $learners->load('scholarship');

        return array_merge(
            $learners->getAttributes(),
            [
                'scholarship' => $learners->scholarship ? $learners->scholarship : null,
                'full_name' => trim($learners->first_name . ' ' . $learners->middle_name . ' ' . $learners->last_name),
                'age' => $learners->age(),
            ]
        );
    }

    protected function logAction(Learners $learners, string $action, array $data): void
    {
        ActivityLog::create([
            'user_name'  => Auth::check() ? Auth::user()->name : null,
            'user_id'    => Auth::id(),
            'model_type' => get_class($learners),
            'model_id'   => $learners->id,
            'action'     => $action,
            'changes'    => json_encode($data),
        ]);
    }
}
