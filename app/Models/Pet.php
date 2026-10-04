<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pet extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'pet_type', 'age', 'breed', 'notes', 'user_id'];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function getAgeLabelAttribute()
    {
        if (!$this->age) {
            return 'Age not specified';
        }

        return $this->age . ' ' . ($this->age == 1 ? 'year' : 'years') . ' old';
    }
}

// This is the reverse — "a Pet has many Bookings" 
// (one pet can be booked for daycare on many different days over time).

// User → hasMany → Pet → hasMany → Booking, and reverse: 
// Booking → belongsTo → Pet → belongsTo → User.