<?php

namespace App\Observers;

use App\Models\ActivityLog;
use App\Models\TrialTeral;
use Illuminate\Support\Facades\Auth;

class TrialTeralObserver
{
    /**
     * Handle the TrialTeral "created" event.
     */
    public function created(TrialTeral $trialTeral): void
    {
        //
        $this->logAction($trialTeral, 'created',$trialTeral->getChanges());

    }

    /**
     * Handle the TrialTeral "updated" event.
     */
    public function updated(TrialTeral $trialTeral): void
    {
        //
        $changes = $trialTeral->getChanges();
        unset($changes['updated_at']); // optional
        $this->logAction($trialTeral, 'updated', $changes);   

    }

    /**
     * Handle the TrialTeral "deleted" event.
     */
    public function deleted(TrialTeral $trialTeral): void
    {
        $this->logAction($trialTeral, 'deleted');
    }

    /**
     * Handle the TrialTeral "restored" event.
     */
    public function restored(TrialTeral $trialTeral): void
    {
        //
    }

    /**
     * Handle the TrialTeral "force deleted" event.
     */
    public function forceDeleted(TrialTeral $trialTeral): void
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
}
