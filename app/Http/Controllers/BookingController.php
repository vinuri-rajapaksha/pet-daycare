<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Pet;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $pets = auth()->user()->pets;

        $bookings = Booking::whereIn('pet_id', $pets->pluck('id'))
            ->with('pet')
            ->orderBy('booking_date')
            ->get();

        return view('bookings.index', [
            'pets' => $pets,
            'bookings' => $bookings,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pet_ids' => 'required|array|min:1',
            'pet_ids.*' => 'exists:pets,id',
            'booking_date' => 'required|date|after_or_equal:today',
            'service_type' => 'required|in:daycare,overnight,grooming',
            'duration' => 'required|integer|min:1|max:30',
            'contact_phone' => 'nullable|string|max:20',
        ]);

        foreach ($validated['pet_ids'] as $petId) {
            $pet = Pet::findOrFail($petId);

            if ($pet->user_id !== auth()->id()) {
                abort(403);
            }

            Booking::create([
                'pet_id' => $pet->id,
                'booking_date' => $validated['booking_date'],
                'service_type' => $validated['service_type'],
                'duration' => $validated['duration'],
                'contact_phone' => $validated['contact_phone'] ?? null,
                'status' => 'pending',
            ]);
        }

        return redirect()->route('bookings.index');
    }
}
// $pets->pluck('id') — grabs just the ID numbers from the user's pets (e.g. [1, 2]), 
// so we can find all bookings belonging to any of their pets

// ->with('pet') — this is called eager loading. Without it, Laravel would run a separate query 
// for each booking's pet info (slow). This grabs it all in one efficient query — worth mentioning 
// in your report as a performance-conscious choice

// 'booking_date' => 'required|date|after_or_equal:today' — validation that blocks booking a date 
// in the past

// The security check (if ($pet->user_id !== auth()->id())) — this stops someone from booking a 
// different user's pet by tampering with the form. This is an important one for your security 
// write-up — it's an authorization check, not just authentication.