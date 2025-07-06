<?php

namespace App\Observers;

use App\Models\ActivityLog;
use App\Models\Aid;
use Illuminate\Support\Facades\Auth;

class AidObserver
{
    /**
     * Handle the Aid "created" event.
     */
    public function created(Aid $aid): void
    {
        $aid->load('type'); // Load relation
    
        $this->logAction($aid, 'created', [
            'after' => array_merge(
                $aid->getAttributes(),
                ['type' => $aid->type ? $aid->type->only(['id', 'name_en','name_ar']) : null]
            ),
        ]);
    }

    public function updated(Aid $aid): void
    {
        $aid->load('type');

        $before = $aid->getOriginal();
        $after = $aid->getAttributes();

        unset($before['updated_at'], $after['updated_at']);

        $this->logAction($aid, 'updated', [
            'before' => array_merge(
                $before,
                ['type' => $aid->type ? $aid->type->only(['id', 'name']) : null]
            ),
            'after' => array_merge(
                $after,
                ['type' => $aid->type ? $aid->type->only(['id', 'name']) : null]
            ),
        ]);
    }

    public function deleted(Aid $aid): void
    {
        $aid->load('type');

        $this->logAction($aid, 'deleted', [
            'before' => array_merge(
                $aid->getOriginal(),
                ['type' => $aid->type ? $aid->type->only(['id', 'name']) : null]
            ),
        ]);
    }
    /**
     * Handle the Aid "restored" event.
     */
    public function restored(Aid $aid): void
    {
        //
    }

    /**
     * Handle the Aid "force deleted" event.
     */
    public function forceDeleted(Aid $aid): void
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
 