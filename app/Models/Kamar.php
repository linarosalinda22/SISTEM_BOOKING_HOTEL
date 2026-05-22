<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kamar extends Model
{
    use HasFactory;

    protected $table = 'kamar';

    protected $fillable = [
        'nomor_kamar',
        'tipe_kamar_id',
        'lantai',
        'status_kamar',
    ];

    /**
     * Get the tipe_kamar for this kamar
     */
    public function tipeKamar(): BelongsTo
    {
        return $this->belongsTo(TipeKamar::class, 'tipe_kamar_id');
    }

    /**
     * Get all bookings for this kamar
     */
    public function booking(): HasMany
    {
        return $this->hasMany(Booking::class, 'kamar_id');
    }
}
