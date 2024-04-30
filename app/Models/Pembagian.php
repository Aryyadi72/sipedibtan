<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembagian extends Model
{
    use HasFactory;

    protected $table = 'pembagian';

    protected $fillable = [
        'bibit_id',
        'jumlah',
        'lokasi',
        'keterangan',
        'foto',
        'inputed_by',
        'tanggal'
    ];

    public function bibit()
    {
        return $this->belongsTo(Bibit::class, 'bibit_id');
    }
}
