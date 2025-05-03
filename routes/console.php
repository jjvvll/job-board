<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


use Illuminate\Support\Facades\Schedule;
use App\Models\Job;

Schedule::call(function () {
    Job::onlyTrashed()->forceDelete(); // Permanently delete soft-deleted jobs
})->everyMinute(); // Change to ->daily() in production


