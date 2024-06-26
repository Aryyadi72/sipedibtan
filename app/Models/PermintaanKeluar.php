<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermintaanKeluar extends Model
{
    use HasFactory;

    protected $table = 'permintaan_keluar';

    protected $fillable = [
        'users_id',
        'permintaan_masuk_id',
        'catatan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function permintaan_masuk()
    {
        return $this->belongsTo(PermintaanMasuk::class, 'permintaan_masuk_id');
    }
}
