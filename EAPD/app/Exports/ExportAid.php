<?php

namespace App\Exports;

use App\Models\Aid;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class ExportAid implements FromView
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
                'data' => Aid::all()->orderBy('ship_date', 'asc'),
            ]);

        } else {
            return view($this->view.'.excel', [
                'data' => Aid::whereIn('id', $this->ids)->orderBy('ship_date', 'asc')->get(),
            ]);
        }

    }
}
