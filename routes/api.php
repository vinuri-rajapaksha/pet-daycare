<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Pet;
use App\Models\Booking;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {

    // GET /api/pets — list the user's pets
    Route::get('/pets', function (Request $request) {
        try {
            return response()->json($request->user()->pets()->paginate(10));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to fetch pets.'], 500);
        }
    });

    // POST /api/pets — create a new pet
    Route::post('/pets', function (Request $request) {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'pet_type' => 'required|in:dog,cat',
                'age' => 'nullable|integer|min:0|max:30',
                'breed' => 'nullable|string|max:255',
                'notes' => 'nullable|string',
            ]);

            $pet = $request->user()->pets()->create($validated);

            return response()->json($pet, 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to create pet.'], 500);
        }
    });

    // DELETE /api/pets/{id} — delete a pet
    Route::delete('/pets/{pet}', function (Request $request, Pet $pet) {
        try {
            if ($pet->user_id !== $request->user()->id) {
                return response()->json(['error' => 'Forbidden.'], 403);
            }

            $pet->delete();

            return response()->json(['message' => 'Pet deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to delete pet.'], 500);
        }
    });

    // GET /api/bookings — list the user's bookings
    Route::get('/bookings', function (Request $request) {
        try {
            $petIds = $request->user()->pets->pluck('id');

            return response()->json(
                Booking::whereIn('pet_id', $petIds)->with('pet')->orderBy('booking_date')->paginate(10)
            );
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to fetch bookings.'], 500);
        }
    });

    // POST /api/bookings — create a new booking
    Route::post('/bookings', function (Request $request) {
        try {
            $validated = $request->validate([
                'pet_id' => 'required|exists:pets,id',
                'booking_date' => 'required|date|after_or_equal:today',
                'service_type' => 'required|in:daycare,overnight,grooming',
                'duration' => 'required|integer|min:1|max:30',
                'contact_phone' => 'nullable|string|max:20',
            ]);

            $pet = Pet::findOrFail($validated['pet_id']);

            if ($pet->user_id !== $request->user()->id) {
                return response()->json(['error' => 'Forbidden.'], 403);
            }

            $booking = Booking::create([
                'pet_id' => $pet->id,
                'booking_date' => $validated['booking_date'],
                'service_type' => $validated['service_type'],
                'duration' => $validated['duration'],
                'contact_phone' => $validated['contact_phone'] ?? null,
                'status' => 'pending',
            ]);

            return response()->json($booking, 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to create booking.'], 500);
        }
    });

    // PATCH /api/bookings/{id} — update a booking's status
    Route::patch('/bookings/{booking}', function (Request $request, Booking $booking) {
        try {
            if ($booking->pet->user_id !== $request->user()->id) {
                return response()->json(['error' => 'Forbidden.'], 403);
            }

            $validated = $request->validate([
                'status' => 'required|in:pending,confirmed,cancelled',
            ]);

            $booking->update(['status' => $validated['status']]);

            return response()->json($booking);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to update booking.'], 500);
        }
    });
});
