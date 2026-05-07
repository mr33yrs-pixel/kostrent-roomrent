<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class RoomController extends Controller
{
    /**
     * Display a listing of available rooms, grouped by type.
     * Single cache key consolidates 3 former cache reads into 1.
     */
    public function index(): View
    {
        $pp = (int) request()->get('premium_page', 1);
        $sp = (int) request()->get('standard_page', 1);
        $ep = (int) request()->get('economic_page', 1);

        $cols = ['id', 'name', 'slug', 'type', 'price', 'price_6_months', 'price_yearly', 'images', 'is_available'];

        $data = Cache::remember("rooms.all.{$pp}.{$sp}.{$ep}", 300, function () use ($pp, $sp, $ep, $cols) {
            return [
                'premium'  => Room::where('type', 'premium')->select($cols)->latest()->paginate(6, ['*'], 'premium_page', $pp),
                'standard' => Room::where('type', 'standard')->select($cols)->latest()->paginate(6, ['*'], 'standard_page', $sp),
                'economic' => Room::where('type', 'economic')->select($cols)->latest()->paginate(6, ['*'], 'economic_page', $ep),
            ];
        });

        return view('rooms', [
            'premiumRooms'  => $data['premium'],
            'standardRooms' => $data['standard'],
            'economicRooms' => $data['economic'],
        ]);
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
