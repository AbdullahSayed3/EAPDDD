<?php

use Illuminate\Support\Facades\Facade;

return [

    'awt' => false,

    'aliases' => Facade::defaultAliases()->merge([
        'DataTables' => Yajra\DataTables\Facades\DataTables::class,
        'Excel' => Maatwebsite\Excel\Facades\Excel::class,
        'FormBuilder' => Kris\LaravelFormBuilder\Facades\FormBuilder::class,
        'Redis' => Illuminate\Support\Facades\Redis::class,
        'Token' => \Dirape\Token\Facades\Facade::class,
    ])->toArray(),

];
