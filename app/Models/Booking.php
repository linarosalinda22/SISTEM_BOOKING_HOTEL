<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';

    protected $fillable = [
        'booking_id',
        'tanggal_pembayaran',
        'metode_pembayaran',
        'total_bayar',
        'status_pembayaran',
    ];

    protected $casts = [
        'tanggal_pembayaran' => 'date',
        'total_bayar' => 'decimal:2',
    ];

    /**
     * Get the booking for this pembayaran
     */
    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }
}
