<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'status_booking'
    ];
    protected $casts = [
        'tanggal_checkin' => 'date',
        'tanggal_checkout' => 'date',
    ];

    public function tamu()
    {
        return $this->belongsTo(Tamus::class);
    }

    public function kamar()
    {
        return $this->belongsTo(Kamar::class);
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class);
    }
}