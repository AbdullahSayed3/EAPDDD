<?php

namespace App\Exports;

use App\Models\Expert;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class ExportExpert implements FromView
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
            return view($this->view . '.excel', [
                'data' => Expert::orderBy('contract_date', 'asc')->get(),
            ]);
        } else {
            return view($this->view . '.excel', [
                'data' => Expert::whereIn('id', $this->ids)->orderBy('contract_date', 'asc')->get(),
            ]);
        }
    }
}
