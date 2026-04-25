<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Destination;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index()
    {
        $hotels = Hotel::all();
        $destinations = Destination::all();

        return view('hotels', compact('hotels', 'destinations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'map_location' => 'required',
            'image' => 'nullable',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'destination_id' => 'required'
        ]);

        Hotel::create([
            'name' => $request->name,
            'description' => $request->description,
            'map_location' => $request->map_location,
            'image' => $request->image,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'destination_id' => $request->destination_id,
        ]);

        return redirect()->back()->with('success', 'Hotel added successfully!');
    }
    public function destroy($id)
    {
        $hotel = Hotel::findOrFail($id);
        $hotel->delete();

        return redirect()->back()->with('success', 'Hotel deleted successfully!');
    }
}