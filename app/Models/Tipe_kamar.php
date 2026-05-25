<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tipe_kamar extends Model
{
    protected $table = 'tipe_kamars';

    protected $fillable = [
        'nama_tipe',
        'deskripsi',
        'harga',
        'kapasitas',
        'foto'
    ];
}