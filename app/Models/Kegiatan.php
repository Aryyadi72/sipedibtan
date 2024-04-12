<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $table = 'kegiatan';

    protected $fillable = [
        'kegiatan',
        'pelaksana',
        'lokasi',
        'keterangan',
        'foto',
        'inputed_by'
    ];
}
