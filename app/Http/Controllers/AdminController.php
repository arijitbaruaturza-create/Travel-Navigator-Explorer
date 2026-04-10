<?php

namespace App\Http\Controllers;

use App\Models\RoomRequest;
use App\Models\Room;

class AdminController extends Controller
{
    public function __construct()
    {
        // Middleware: require login for all methods
        $this->middleware(function ($request, $next) {
            if (!session()->has('admin_id')) {
                return redirect('/admin/login')->with('error', 'Please login first.');
            }
            return $next($request);
        });
    }

    public function index()
    {
        $requests = RoomRequest::latest()->get();
        return view('admin.index', compact('requests'));
    }

    public function show($id)
    {
        $room = RoomRequest::findOrFail($id);
        return view('admin.show', compact('room'));
    }

    public function approve($id)
    {
        $req = RoomRequest::findOrFail($id);

        Room::create([
            'name' => $req->name,
            'price' => $req->price,
            'sqft' => $req->sqft,
            'persons' => $req->persons,
            'description' => $req->description,
            'services' => $req->services,
            'image' => $req->image,
        ]);

        $req->update(['status' => 'approved']);

        return redirect('/admin/dashboard')->with('success', 'Room approved.');
    }

    public function reject($id)
    {
        RoomRequest::findOrFail($id)->update(['status' => 'rejected']);
        return redirect('/admin/dashboard')->with('error', 'Room rejected.');
    }
}