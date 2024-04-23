<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biodata extends Model
{
    use HasFactory;

    protected $table = 'biodata';

    protected $fillable = [
        'users_id',
        'nama',
        'alamat',
        'jenis_kelamin',
        'umur',
        'tempat_lahir',
        'tanggal_lahir',
        'no_ktp',
        'no_telpon',
        'pendidikan',
        'agama',
        'domisili',
        'inputed_by'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
