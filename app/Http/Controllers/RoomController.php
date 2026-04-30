<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\RoomRequest;

class RoomController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Dashboard + Search (MAIN FEATURE)
    |--------------------------------------------------------------------------
    */
    public function search(Request $request)
    {
        $query = Room::query();

        // Budget filter
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Guests filter
        if ($request->filled('guests')) {
            $query->where('persons', '>=', $request->guests);
        }

        // Date validation (optional for now)
        if ($request->filled('checkin') && $request->filled('checkout')) {
            $request->validate([
                'checkin' => 'date',
                'checkout' => 'date|after:checkin',
            ]);
        }

        // If no filters → don't show all rooms immediately (optional UX choice)
        if (!$request->hasAny(['min_price', 'max_price', 'guests', 'checkin', 'checkout'])) {
            return view('customer.dashboard');
        }

        $rooms = $query->get();

        return view('customer.dashboard', compact('rooms'));
    }


    /*
    |--------------------------------------------------------------------------
    | Show all rooms (admin/general page)
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $rooms = Room::all();
        return view('rooms', compact('rooms'));
    }


    /*
    |--------------------------------------------------------------------------
    | Show single room
    |--------------------------------------------------------------------------
    */
    public function show($id)
    {
        $room = Room::find($id);

        if (!$room) {
            return redirect()->back()->with('error', 'Room not found.');
        }

        return view('room', compact('room'));
    }


    /*
    |--------------------------------------------------------------------------
    | Store new room (request for admin approval)
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'sqft' => 'nullable|numeric',
            'persons' => 'nullable|numeric',
            'description' => 'required|string',
            'services' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('rooms', 'public');
        }

        RoomRequest::create([
            'name' => $request->name,
            'price' => $request->price,
            'sqft' => $request->sqft,
            'persons' => $request->persons,
            'description' => $request->description,
            'services' => $request->services,
            'image' => $imagePath,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Room submitted for admin approval!');
    }


    /*
    |--------------------------------------------------------------------------
    | Edit room
    |--------------------------------------------------------------------------
    */
    public function edit($id)
    {
        $room = Room::find($id);

        if (!$room) {
            return redirect()->back()->with('error', 'Room not found.');
        }

        return view('edit-room', compact('room'));
    }


    /*
    |--------------------------------------------------------------------------
    | Update room
    |--------------------------------------------------------------------------
    */
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


    /*
    |--------------------------------------------------------------------------
    | Delete room
    |--------------------------------------------------------------------------
    */
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
    |--------------------------------------------------------------------------
    | Cost Calculator
    |--------------------------------------------------------------------------
    */
    public function costForm()
    {
        $rooms = Room::all();
        return view('cost', compact('rooms'));
    }

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
}