<?php

namespace App\Observers;

use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        //
        $this->logAction($user, 'created',['after'=>$user->getAttributes()]);

    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        //
        $changes = $user->getAttribute;
        unset($changes['updated_at']); // optional
        $this->logAction($user, 'updated', ['after'=>$changes,'before'=>$user->getOriginal()]);   

    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        $this->logAction($user, 'deleted',['before'=>$user->getOriginal()]);
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
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
