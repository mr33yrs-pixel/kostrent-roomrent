<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $facilities = [
            'Motorcycle Parking',
            'High-Speed WiFi',
            'Shared Kitchen',
            'Private Bathroom',
        ];

        $rooms = [
            [
                'name' => 'Premium 1',
                'slug' => 'premium-1',
                'type' => 'premium',
                'price' => 2500000,
                'price_6_months' => 14000000,
                'price_yearly' => 27000000,
                'description' => '<p>Experience luxury living in our Premium 1 room. This spacious room features modern furnishings, excellent natural lighting, and premium amenities for your comfort.</p><p>Perfect for professionals or students who appreciate quality living spaces.</p>',
                'facilities' => $facilities,
                'images' => [],
                'is_available' => true,
            ],
            [
                'name' => 'Premium 2',
                'slug' => 'premium-2',
                'type' => 'premium',
                'price' => 2500000,
                'price_6_months' => 14000000,
                'price_yearly' => 27000000,
                'description' => '<p>Our Premium 2 room offers the same exceptional quality as Premium 1 with a unique layout. Enjoy a comfortable and stylish space designed for modern living.</p><p>All premium amenities included for a superior boarding experience.</p>',
                'facilities' => $facilities,
                'images' => [],
                'is_available' => true,
            ],
            [
                'name' => 'Standard 1',
                'slug' => 'standard-1',
                'type' => 'standard',
                'price' => 1500000,
                'price_6_months' => 8500000,
                'price_yearly' => 16000000,
                'description' => '<p>Standard 1 provides excellent value with all the essentials you need. A comfortable and practical space for budget-conscious residents.</p><p>All basic amenities included for a pleasant stay.</p>',
                'facilities' => $facilities,
                'images' => [],
                'is_available' => true,
            ],
            [
                'name' => 'Standard 2',
                'slug' => 'standard-2',
                'type' => 'standard',
                'price' => 1500000,
                'price_6_months' => 8500000,
                'price_yearly' => 16000000,
                'description' => '<p>Standard 2 offers the same great value as Standard 1. A cozy room perfect for those seeking affordable and comfortable accommodation.</p><p>Clean, well-maintained, and ready for you to move in.</p>',
                'facilities' => $facilities,
                'images' => [],
                'is_available' => true,
            ],
        ];

        foreach ($rooms as $room) {
            Room::updateOrCreate(
                ['slug' => $room['slug']],
                $room
            );
        }
    }
}
