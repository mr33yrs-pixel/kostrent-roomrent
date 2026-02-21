<?php

namespace Tests\Feature;

use App\Jobs\LogVisitJob;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class LogVisitJobTest extends TestCase
{
    use RefreshDatabase;

    public function test_visiting_home_page_dispatches_log_visit_job(): void
    {
        Queue::fake();

        $response = $this->get('/');
        $response->assertStatus(200);

        Queue::assertPushed(LogVisitJob::class);
    }

    public function test_log_visit_job_inserts_to_database(): void
    {
        $data = [
            'ip_address' => '127.0.0.1',
            'url' => 'http://localhost/rooms',
            'user_agent' => 'TestAgent',
            'user_id' => null,
            'meta' => ['referer' => null]
        ];

        $job = new LogVisitJob($data);
        $job->handle();

        $this->assertDatabaseHas('visits', [
            'ip_address' => '127.0.0.1',
            'url' => 'http://localhost/rooms',
        ]);
    }
}

