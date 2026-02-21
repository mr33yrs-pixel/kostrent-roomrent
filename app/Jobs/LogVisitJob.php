<?php

namespace App\Jobs;

use App\Models\Visit;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class LogVisitJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public array $visitData)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            Visit::create($this->visitData);
        } catch (\Throwable $e) {
            report($e);
        }
    }
}
