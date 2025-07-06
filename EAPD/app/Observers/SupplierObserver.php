<?php

namespace App\Observers;

use App\Models\ActivityLog;
use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;

class SupplierObserver
{
     public function created(Supplier $supplier): void
    {
        $this->logAction($supplier, 'created', ['after'=>$this->buildEventLogData($supplier)]);
    }

    public function updated(Supplier $supplier): void
    {
        $this->logAction($supplier, 'updated', ['before'=>$supplier->getOriginal,'after'=>$this->buildEventLogData($supplier)]);
    }

    public function deleted(Supplier $supplier): void
    {
        $this->logAction($supplier, 'deleted', ['before'=>$this->buildEventLogData($supplier)]);
    }

    public function restored(Supplier $supplier): void {}
    public function forceDeleted(Supplier $supplier): void {}

    protected function buildEventLogData(Supplier $supplier): array
    {
        return $supplier->getAttributes();
    }

    protected function logAction(Supplier $model, string $action, array $changes): void
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
