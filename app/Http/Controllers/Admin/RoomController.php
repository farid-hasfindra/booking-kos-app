<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\RoomImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = Room::latest()->paginate(10);
        return view('admin.rooms.index', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.rooms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'facilities' => 'required|string',
            'location' => 'required|string',
            'status' => 'required|in:available,full',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Primary image
        ]);

        $room = Room::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . Str::random(5),
            'price' => $request->price,
            'description' => $request->description,
            'facilities' => $request->facilities,
            'location' => $request->location,
            'status' => $request->status,
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('rooms', 'public');
            RoomImage::create([
                'room_id' => $room->id,
                'image_path' => $path,
                'is_primary' => true,
            ]);
        }

        return redirect()->route('admin.rooms.index')->with('success', 'Kamar berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        return view('admin.rooms.edit', compact('room'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'facilities' => 'required|string',
            'location' => 'required|string',
            'status' => 'required|in:available,full',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $room->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'facilities' => $request->facilities,
            'location' => $request->location,
            'status' => $request->status,
        ]);

        if ($request->hasFile('image')) {
            // Optional: Delete old primary image? For now just add as new primary and unset others.
            // Or replace logic. Let's simplfy: Replace primary.

            // Unset old primary
            RoomImage::where('room_id', $room->id)->where('is_primary', true)->update(['is_primary' => false]);

            $path = $request->file('image')->store('rooms', 'public');
            RoomImage::create([
                'room_id' => $room->id,
                'image_path' => $path,
                'is_primary' => true,
            ]);
        }

        return redirect()->route('admin.rooms.index')->with('success', 'Kamar berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        // Images should cascade delete in DB, but files on disk remain.
        // For production, we should delete files too.
        $room->delete();
        return redirect()->route('admin.rooms.index')->with('success', 'Kamar berhasil dihapus.');
    }
}
