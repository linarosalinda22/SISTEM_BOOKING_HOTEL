<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipeKamar extends Model
{
    use HasFactory;

    protected $table = 'tipe_kamar';

    protected $fillable = [
        'nama_tipe',
        'deskripsi',
        'harga',
        'kapasitas'
    ];

    public function kamar()
    {
        return $this->hasMany(Kamar::class);
    }
}
