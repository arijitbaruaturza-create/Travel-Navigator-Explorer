<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\RoomRequest; // ✅ Added this import

class RoomController extends Controller
{
    // Show all approved rooms
    public function index()
    {
        $rooms = Room::all();
        return view('rooms', compact('rooms'));
    }

    // Show single room
    public function show($id)
    {
        $room = Room::find($id);
        if (!$room) {
            return redirect()->back()->with('error', 'Room not found.');
        }
        return view('room', compact('room'));
    }

    // Store a new room request
    public function store(Request $request)
    {
        // 🔹 Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'sqft' => 'nullable|numeric',
            'persons' => 'nullable|numeric',
            'description' => 'required|string',
            'services' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // 🔹 Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('rooms', 'public');
        }

        // 🔹 Store into room_requests table
        RoomRequest::create([
            'name' => $request->name,
            'price' => $request->price,
            'sqft' => $request->sqft,
            'persons' => $request->persons,
            'description' => $request->description,
            'services' => $request->services,
            'image' => $imagePath,
            'status' => 'pending', // default status
        ]);

        return redirect()->back()->with('success', 'Room submitted for admin approval!');
    }

    // Show edit form for approved rooms
    public function edit($id)
    {
        $room = Room::find($id);
        if (!$room) {
            return redirect()->back()->with('error', 'Room not found.');
        }
        return view('edit-room', compact('room'));
    }

    // Update an approved room
    public function update(Request $request, $id)
    {
        $room = Room::find($id);
        if (!$room) {
            return redirect()->back()->with('error', 'Room not found.');
        }

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('rooms', 'public');
            $room->image = $imagePath;
        }

        $room->name = $request->name;
        $room->price = $request->price;
        $room->description = $request->description;
        $room->sqft = $request->sqft;
        $room->persons = $request->persons;
        $room->services = $request->services;

        $room->save();

        return redirect('/rooms')->with('success', 'Room updated successfully.');
    }

    // Delete an approved room
    public function delete($id)
    {
        $room = Room::find($id);
        if ($room) {
            $room->delete();
            return redirect('/rooms')->with('success', 'Room deleted successfully.');
        }
        return redirect('/rooms')->with('error', 'Room not found.');
    }

    /*
    |--------------------------------------------------------------------
    | Cost Calculator Feature
    |--------------------------------------------------------------------
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

        if (!$room) {
            return redirect()->back()->with('error', 'Room not found.');
        }

        $total = $room->price * $nights;

        return view('cost_result', compact('room', 'nights', 'total'));
    }
	    // -------------------------------
    // Travel Budget Feature
    // -------------------------------

    public function travelBudgetForm()
    {
        return view('travel_budget');
    }

    public function travelBudgetCalculate(Request $request)
    {
        $request->validate([
            'hotel_cost' => 'required|numeric',
            'nights' => 'required|numeric',
            'food_per_day' => 'required|numeric',
            'transport_cost' => 'required|numeric',
        ]);

        $hotelTotal = $request->hotel_cost * $request->nights;
        $foodTotal = $request->food_per_day * $request->nights;
        $transportTotal = $request->transport_cost;

        $total = $hotelTotal + $foodTotal + $transportTotal;

        if ($total < 5000) {
            $category = "Budget";
        } elseif ($total < 15000) {
            $category = "Moderate";
        } else {
            $category = "Luxury";
        }

        return view('travel_budget_result', compact('total', 'category'));
    }
}