<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'booking';

    protected $fillable = [
        'tamu_id',
        'kamar_id',
        'tanggal_checkin',
        'tanggal_checkout',
        'lama_menginap',
        'total_harga',
        'status_booking',
    ];

    protected $casts = [
        'tanggal_checkin' => 'date',
        'tanggal_checkout' => 'date',
        'total_harga' => 'decimal:2',
    ];

    /**
     * Get the tamu for this booking
     */
    public function tamu(): BelongsTo
    {
        return $this->belongsTo(Tamus::class, 'tamu_id');
    }

    /**
     * Get the kamar for this booking
     */
    public function kamar(): BelongsTo
    {
        return $this->belongsTo(Kamar::class, 'kamar_id');
    }

    /**
     * Get the pembayaran for this booking
     */
    public function pembayaran(): HasOne
    {
        return $this->hasOne(Pembayaran::class, 'booking_id');
    }
}
