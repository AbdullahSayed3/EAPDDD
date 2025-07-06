<?php

namespace App\Exports;

use App\Models\CoursePartner;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class ExportPartner implements FromView
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
                'data' => CoursePartner::all(),
            ]);

        } else {
            return view($this->view.'.excel', [
                'data' => CoursePartner::whereIn('id', $this->ids)->get(),
            ]);
        }

    }
}
