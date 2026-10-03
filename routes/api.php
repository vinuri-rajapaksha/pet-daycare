<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->get('/pets', function (Request $request) {
    return $request->user()->pets;
});

Route::middleware('auth:sanctum')->get('/bookings', function (Request $request) {
    $petIds = $request->user()->pets->pluck('id');

    return \App\Models\Booking::whereIn('pet_id', $petIds)
        ->with('pet')
        ->orderBy('booking_date')
        ->get();
});

// Route::middleware('auth:sanctum') — this is the gate. Any request to this route must include a 
// valid Sanctum access token, or it gets rejected with an "Unauthenticated" error.
// $request->user() — Sanctum figures out which user the token belongs to, and gives you that user 
// automatically
// ->pets — using the same relationship you built earlier, returns all of that user's pets
