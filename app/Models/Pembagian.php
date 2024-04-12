<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembagian extends Model
{
    use HasFactory;

    protected $table = 'kegiatan';

    protected $fillable = [
        'bibit_id',
        'jumlah',
        'lokasi',
        'keterangan',
        'koordinat',
        'foto',
        'inputed_by'
    ];

    public function bibit()
    {
        return $this->belongsTo(Bibit::class, 'bibit_id');
    }
}
