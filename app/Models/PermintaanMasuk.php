<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermintaanMasuk extends Model
{
    use HasFactory;

    protected $table = 'permintaan_masuk';

    protected $fillable = [
        'user_id',
        'bibit_id',
        'jumlah',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function bibit()
    {
        return $this->belongsTo(Bibit::class, 'bibit_id');
    }
}
