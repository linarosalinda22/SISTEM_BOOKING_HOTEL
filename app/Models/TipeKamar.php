<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TipeKamar extends Model
{
    use HasFactory;

    protected $table = 'tipe_kamar';

    protected $fillable = [
        'nama_tipe',
        'harga_per_malam',
        'kapasitas',
        'fasilitas',
        'deskripsi',
        'foto',
    ];

    /**
     * Get all kamar for this tipe_kamar
     */
    public function kamar(): HasMany
    {
        return $this->hasMany(Kamar::class, 'tipe_kamar_id');
    }
}
