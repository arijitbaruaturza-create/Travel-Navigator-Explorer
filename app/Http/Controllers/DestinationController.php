<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destination;

class DestinationController extends Controller
{
    // Show all destinations
    public function index()
    {
        $destinations = Destination::all();
        return view('destinations.index', compact('destinations'));
    }

    // Search destinations by name or category
    public function search(Request $request)
    {
        $query = $request->input('query', '');

        if (empty($query)) {
            return response()->json([]);
        }

        $destinations = Destination::where('name', 'LIKE', "%{$query}%")
            ->orWhere('category', 'LIKE', "%{$query}%")
            ->get();

        return response()->json($destinations);
    }

    // Show a single destination detail
    public function show($id)
    {
        $destination = Destination::findOrFail($id);
        return view('destinations.show', compact('destination'));
    }
}