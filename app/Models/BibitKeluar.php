<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BibitKeluar extends Model
{
    use HasFactory;

    protected $table = 'bibit_keluar';

    protected $fillable = [
        'bibit_id',
        'tanggal',
        'jumlah',
        'keterangan',
        'inputed_by'
    ];

    public function bibit()
    {
        return $this->belongsTo(Bibit::class, 'bibit_id');
    }
}
