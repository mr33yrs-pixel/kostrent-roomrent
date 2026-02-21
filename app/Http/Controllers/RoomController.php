<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class RoomController extends Controller
{
    /**
     * Display a listing of available rooms, grouped by type.
     * Cached for 5 minutes since room data changes infrequently.
     */
    public function index(): View
    {
        $premiumPage = request()->get('premium_page', 1);
        $standardPage = request()->get('standard_page', 1);

        $premiumRooms = Cache::remember("rooms.premium.page.{$premiumPage}", 300, function () {
            return Room::query()
                ->select(['id', 'name', 'slug', 'type', 'price', 'price_6_months', 'price_yearly', 'images', 'is_available'])
                ->where('type', 'premium')
                ->latest()
                ->paginate(6, ['*'], 'premium_page');
        });

        $standardRooms = Cache::remember("rooms.standard.page.{$standardPage}", 300, function () {
            return Room::query()
                ->select(['id', 'name', 'slug', 'type', 'price', 'price_6_months', 'price_yearly', 'images', 'is_available'])
                ->where('type', 'standard')
                ->latest()
                ->paginate(6, ['*'], 'standard_page');
        });

        return view('rooms', compact('premiumRooms', 'standardRooms'));
    }

    /**
     * Display the specified room.
     * Uses route model binding with slug as the route key.
     */
    public function show(Room $room): View
    {
        return view('room-detail', compact('room'));
    }
}
