<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

// Prune visits older than 90 days daily to prevent unbounded table growth
Schedule::command('model:prune', ['--model' => \App\Models\Visit::class])->daily();
