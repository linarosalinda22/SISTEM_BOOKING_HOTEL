<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tamus extends Model
{
    use HasFactory;

    protected $table = 'tamuses';

    protected $fillable = [
        'nama_lengkap',
        'jenis_kelamin',
        'no_telepon',
        'email',
        'alamat',
        'no_identitas',
    ];

    /**
     * Get all bookings for this tamu
     */
    public function booking(): HasMany
    {
        return $this->hasMany(Booking::class, 'tamu_id');
    }
}
