<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'room_number', 'type',
        'price_per_night', 'max_guests', 'description',
        'facilities', 'photo', 'status',
    ];

    protected $casts = [
        'facilities'     => 'array',
        'price_per_night' => 'decimal:2',
    ];

    // ── Relationships ──────────────────────────────────────────────────────────

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    // ── Scopes ─────────────────────────────────────────────────────────────────

    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }
}