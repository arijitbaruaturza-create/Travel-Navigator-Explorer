<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

class RoomController extends Controller
{
    // Show all rooms
    public function index()
    {
        $rooms = Room::all();
        return view('rooms', compact('rooms'));
    }

    // Show single room
    public function show($id)
    {
        $room = Room::find($id);
        return view('room', compact('room'));
    }

    // Store a new room
    public function store(Request $request)
    {
        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('rooms', 'public');
        }

        Room::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $imagePath,
            'sqft' => $request->sqft,
            'persons' => $request->persons,
			'services' => $request->services,
        ]);

        return redirect()->back();
    }

    // Show edit form
    public function edit($id)
    {
        $room = Room::find($id);
        return view('edit-room', compact('room'));
    }

    // Update room
    public function update(Request $request, $id)
	{
		$room = Room::find($id);

		if ($request->hasFile('image')) {
			$imagePath = $request->file('image')->store('rooms', 'public');
			$room->image = $imagePath;
		}

		$room->name = $request->name;
		$room->price = $request->price;
		$room->description = $request->description;
		$room->sqft = $request->sqft;
		$room->persons = $request->persons;
		$room->services = $request->services; // 👈 ADD THIS

		$room->save();

		return redirect('/rooms');

    }

    // Delete a room
    public function delete($id)
    {
        $room = Room::find($id);

        if ($room) {
            $room->delete();
        }

        return redirect('/rooms');
    }

    /*
    |--------------------------------------------------------------------------
    | Cost Calculator Feature
    |--------------------------------------------------------------------------
    */

    // Show cost form
    public function costForm()
    {
        $rooms = Room::all();
        return view('cost', compact('rooms'));
    }

    // Calculate cost
    public function calculateCost(Request $request)
    {
        $room = Room::find($request->room_id);
        $nights = $request->nights;

        // Safety check (avoid crash)
        if (!$room) {
            return redirect()->back()->with('error', 'Room not found');
        }

        $total = $room->price * $nights;

        return view('cost_result', compact('room', 'nights', 'total'));
    }
}