<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}