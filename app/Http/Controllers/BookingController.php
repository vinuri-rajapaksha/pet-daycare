<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Pet;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index() //show the bookings page
    {
        $pets = auth()->user()->pets; //Gets the logged-in user's pets only. The page needs them for the checkboxes in the booking form.

        $bookings = Booking::whereIn('pet_id', $pets->pluck('id'))
            ->with('pet')
            ->orderBy('booking_date')
            ->get();

        return view('bookings.index', [
            'pets' => $pets,
            'bookings' => $bookings,
        ]);
    }
    // A booking belongs to a pet, not to a user. So you first collect the ids of the user's pets (pluck('id')), 
    // then ask for bookings whose pet_id is in that list (whereIn). That is how one user only sees their own bookings.
    // with('pet') is eager loading. It loads each booking's pet in one extra query, instead of one query per booking 
    // orderBy('booking_date') sorts by date.

    public function store(Request $request) // save a new booking
    {
        $validated = $request->validate([
            'pet_ids' => 'required|array|min:1', //at least one pet must be ticked
            'pet_ids.*' => 'exists:pets,id',
            'booking_date' => 'required|date|after_or_equal:today',
            'service_type' => 'required|in:daycare,overnight,grooming',
            'duration' => 'required|integer|min:1|max:30',
            'contact_phone' => 'nullable|string|max:20',
        ]);

        \Illuminate\Support\Facades\DB::transaction(function () use ($validated) {
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
            // A transaction means all or nothing. Imagine a user ticks 3 pets. If the first booking saves and the 
            // second fails, without a transaction they'd have a half-saved booking. With a transaction, if anything 
            // fails, the database undoes everything and nothing is saved. so the data never ends up half-written.
        });

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