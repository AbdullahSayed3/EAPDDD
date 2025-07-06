<?php

namespace App\Exports;

use App\Models\Scholarships;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class ScholarshipsExport implements FromView
{
    // /**
    // * @return \Illuminate\Support\Collection
    // */
    // public function collection()
    // {
    //     return Scholarships::all();
    // }

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
                'data' => Scholarships::orderBy('start_date', 'asc')->get(),
            ]);

        } else {
            return view($this->view.'.excel', [
                'data' => Scholarships::whereIn('id', $this->ids)->orderBy('start_date', 'asc')->get(),
            ]);
        }

    }
}
