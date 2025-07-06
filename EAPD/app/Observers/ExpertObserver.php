<?php

namespace App\Observers;

use App\Models\ActivityLog;
use App\Models\Expert;
use Illuminate\Support\Facades\Auth;

class ExpertObserver
{
    public function created(Expert $expert): void
    {
        $this->logAction($expert, 'created', [
            'after' => $expert->getAttributes()
        ]);
    }

    public function updated(Expert $expert): void
    {
        $before = $expert->getOriginal();

        $this->logAction($expert, 'updated', [
            'before' => $before,
            'after' => $expert->getAttributes()
        ]);
    }

    public function deleted(Expert $expert): void
    {
        $this->logAction($expert, 'deleted', [
            'before' => $expert->getAttributes()
        ]);
    }

    public function restored(Expert $expert): void
    {
        $this->logAction($expert, 'restored', [
            'after' => $expert->getAttributes()
        ]);
    }

    public function forceDeleted(Expert $expert): void
    {
        $this->logAction($expert, 'force_deleted', [
            'before' => $expert->getAttributes()
        ]);
    }

    protected function logAction($model, $action, $changes = null): void
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
