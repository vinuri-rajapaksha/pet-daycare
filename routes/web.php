<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetController;
use App\Http\Controllers\BookingController;

Route::get('/', function () {
    return view('welcome');
});
// This is the public home page. Route::get means "when someone visits with a GET request", and / is the 
// homepage. It shows resources/views/welcome.blade.php, your landing page with Log in and Register. 
// It has no protection because anyone should be able to see it.


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('pets', PetController::class); //GET, POST, DELETE and PATCH
    Route::resource('bookings', BookingController::class); //GET, POST, DELETE and PATCH
});

// Route::middleware(['auth', 'verified']) — this is the "you must be logged in" gate. 
// Anyone not logged in gets redirected to the login page automatically.

// Route::resource('pets', PetController::class) — this one line secretly creates 7 routes for you 
// (list all pets, show add-pet form, save a new pet, view one pet, show edit form, update a pet, 
// delete a pet) — all pointing to matching methods in PetController that we'll fill in next.
