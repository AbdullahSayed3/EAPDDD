<?php

namespace App\Exports;

use App\Models\Events;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class ExportEvents implements FromView
{
    use Exportable;

    public function __construct(array $ids, $view)
    {
        $this->ids = $ids;
        $this->view = $view;
    }

    public function view(): View
    {
        if (count($this->ids) == 0) {
            return view($this->view.'.excel', [
                'data' => Events::all(),
            ]);

        } else {
            return view($this->view.'.excel', [
                'data' => Events::whereIn('id', $this->ids)->get(),
            ]);
        }

    }
}
