<?php

namespace Tests\Feature;

use App\Models\Room;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class RoomPaginationTest extends TestCase
{
    use RefreshDatabase;

    public function test_rooms_index_uses_pagination_for_premium_and_standard_rooms(): void
    {
        Cache::flush();
        // Create 10 Premium and 10 Standard rooms
        Room::factory()->count(10)->create(['type' => 'premium', 'is_available' => true]);
        Room::factory()->count(10)->create(['type' => 'standard', 'is_available' => true]);

        $response = $this->get('/rooms');

        $response->assertStatus(200);

        // Assert view has premium and standard paginators
        $response->assertViewHas('premiumRooms');
        $response->assertViewHas('standardRooms');

        // Check that pagination applies (only 6 per page)
        $this->assertCount(6, $response->viewData('premiumRooms'));
        $this->assertCount(6, $response->viewData('standardRooms'));
    }
}

