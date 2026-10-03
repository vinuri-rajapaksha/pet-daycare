<?php

namespace App\Livewire;

use App\Models\Booking;
use Livewire\Component;

class BookingList extends Component
{
    public function render()
    {
        $pets = auth()->user()->pets;

        $bookings = Booking::whereIn('pet_id', $pets->pluck('id'))
            ->with('pet')
            ->orderBy('booking_date')
            ->get();

        return view('livewire.booking-list', [
            'bookings' => $bookings,
        ]);
    }

    public function confirm($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);
        $this->authorizeBooking($booking);
        $booking->update(['status' => 'confirmed']);
    }

    public function cancel($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);
        $this->authorizeBooking($booking);
        $booking->update(['status' => 'cancelled']);
    }

    protected function authorizeBooking(Booking $booking)
    {
        if ($booking->pet->user_id !== auth()->id()) {
            abort(403);
        }
    }
}

// What's new: render() runs every time the component loads or updates — it re-fetches bookings fresh 
// each time so the list always stays current. confirm() and cancel() are called directly from button 
// clicks (next file) — no route, no page reload, just PHP methods that Livewire wires up automatically. 
// authorizeBooking() is the same "don't let someone touch another user's data" check from before, 
// reused here for safety.