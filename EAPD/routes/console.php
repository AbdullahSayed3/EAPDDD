<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Schedule::command('inspire')
//          ->hourly();
Schedule::call(function () {
    DB::table('experts')->whereDate('end_date', '<', date('Y-m-d H:i:s'))->update(['status' => 'old']);
})->daily();
