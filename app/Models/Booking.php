<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = ['pet_id', 'booking_date', 'status', 'service_type', 'duration', 'contact_phone'];

    public function pet(): BelongsTo
    {
        return $this->belongsTo(Pet::class);
    }

    public function scopeUpcoming($query)
    {
        return $query->where('booking_date', '>=', now()->toDateString())
            ->where('status', '!=', 'cancelled');
    }
}

// This says "a Booking belongs to one Pet." So $booking->pet gets you the pet, 
// and $booking->pet->owner even gets you the pet's owner — Laravel chains relationships like 
// this automatically.