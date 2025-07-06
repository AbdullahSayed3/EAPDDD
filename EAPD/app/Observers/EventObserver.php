<?php

namespace App\Observers;

use App\Models\ActivityLog;
use App\Models\Events;
use Illuminate\Support\Facades\Auth;

class EventObserver
{
      public function created(Events $events): void
    {
        $events->load('type');

        $this->logAction($events, 'created', [
            'after' => $this->buildEventLogData($events)
        ]);
    }

    public function updated(Events $events): void
    {
        $before = $events->getOriginal();

        $events->load('type');

        $this->logAction($events, 'updated', [
            'before' => $before,
            'after' => $this->buildEventLogData($events)
        ]);
    }

    public function deleted(Events $events): void
    {
        $events->load('type');

        $this->logAction($events, 'deleted', [
            'before' => $this->buildEventLogData($events)
        ]);
    }

    protected function buildEventLogData(Events $event): array
    {
        return array_merge(
            $event->getAttributes(),
            [
                'type' => $event->type ? $event->type->only(['id', 'name_en', 'name_ar']) : null,
                'parsed_participants' => $event->participants ? @unserialize($event->participants) : [],
            ]
        );
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
