<?php

namespace App\Models;
use App\Models\Tipe_kamar;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    use HasFactory;

    protected $table = 'kamar';

    protected $fillable = [
        'nomor_kamar',
        'tipe_kamar_id',
        'harga',
        'status_kamar'
    ];

    public function tipeKamar()
    {
        return $this->belongsTo(Tipe_kamar::class, 'tipe_kamar_id');
    }
}