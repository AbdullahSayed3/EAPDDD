<?php

namespace App\Exports;

use App\Models\Country;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;


class CountryExport implements FromView
{
    use Exportable;
    protected $view;
    protected $ids;
    public function __construct($view, $ids)
    {
        $this->view = $view;
        $this->ids = $ids;
    }

    public function view(): View
    {
        if ($this->ids == 0) {
            return view($this->view . '.excel', [
                'data' => Country::withCount(['application', 'maleApplications', 'femaleApplications'])->latest()->get(),
            ]);
        } else {
            return view($this->view . '.excel', [
                'data' => Country::withCount(['application', 'maleApplications', 'femaleApplications'])
                    ->whereIn('id', $this->ids)->latest()->get(),
            ]);
        }
    }
}
