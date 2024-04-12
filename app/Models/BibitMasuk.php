<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BibitMasuk extends Model
{
    use HasFactory;

    protected $table = 'bibit_masuk';

    protected $fillable = [
        'bibit_id',
        'stok',
        'inputed_by'
    ];

    public function bibit()
    {
        return $this->belongsTo(Bibit::class, 'bibit_id');
    }
}
