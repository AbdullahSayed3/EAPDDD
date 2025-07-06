<?php

namespace App\Exports;

use App\Application;
use App\Models\Application as ModelsApplication;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;

class ApplicationExport implements FromQuery
{
    use Exportable;

    protected $ids;

    public function __construct(array $ids)
    {
        $this->ids = $ids;
    }

    public function query()
    {
        $query = ModelsApplication::with('course')
            ->orderBy('created_at', 'asc');

        if (count($this->ids) > 0) {
            $query->whereIn('id', $this->ids);
        }

        return $query;
    }

    public function chunkSize(): int
    {
        return 500; // Process 500 records at a time
    }
}
