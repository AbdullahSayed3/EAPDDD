<?php

namespace App\Exports;

use App\Models\Learners;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class LearnersExport implements FromView
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
                'data' => Learners::get(),
            ]);
        } else {
            return view($this->view.'.excel', [
                'data' => Learners::whereIn('id', $this->ids)->get(),
            ]);
        }
    }
}
