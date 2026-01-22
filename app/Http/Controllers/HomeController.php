<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $rooms = Room::orderBy('status', 'asc')->latest()->get();
        $landingInfos = \App\Models\LandingInfo::all();
        // If empty (e.g. seed didn't run), fallback or let view handle empty collection
        return view('welcome', compact('rooms', 'landingInfos'));
    }

    public function show(Room $room)
    {
        return view('rooms.show', compact('room'));
    }
}
