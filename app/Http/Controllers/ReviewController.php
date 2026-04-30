<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Guide;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, $guideId)
    {
        $guide = Guide::findOrFail($guideId);

        $request->validate([
            'guest_name' => 'required|string|max:255',
            'guest_email' => 'required|email|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $hasBooking = Booking::where('guide_id', $guide->id)
            ->where('guest_email', $request->guest_email)
            ->exists();

        if (! $hasBooking) {
            return redirect()->route('guides.show', $guide->id)
                ->with('error', 'Please hire this guide first using the same email address before submitting a review.');
        }

        Review::create([
            'guide_id' => $guide->id,
            'guest_name' => $request->guest_name,
            'guest_email' => $request->guest_email,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->route('guides.show', $guide->id)
            ->with('success', 'Thank you! Your review has been added.');
    }
}
