<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = ['pet_id', 'booking_date', 'status', 'service_type', 'duration', 'contact_phone'];
    //This is the list of columns allowed to be saved through create() or update(). It protects against mass 
    // assignment (Saving many fields at once from request data. $fillable limits which fields are accepted.)

    public function pet(): BelongsTo
    {
        return $this->belongsTo(Pet::class);
    }
    //This defines the relationship between a booking and a pet.

    public function scopeUpcoming($query) //query scope reuasable query filter
    {
        return $query->where('booking_date', '>=', now()->toDateString())
            ->where('status', '!=', 'cancelled');
    }
    //all bookings that are scheduled for today or later, as long as they haven't been cancelled.
}

// This says "a Booking belongs to one Pet." So $booking->pet gets you the pet, 
// and $booking->pet->owner even gets you the pet's owner — Laravel chains relationships like 
// this automatically.