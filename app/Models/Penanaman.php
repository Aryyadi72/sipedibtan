<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Penanaman extends Model
{
    use HasFactory;

    protected $table = 'penanaman';

    protected $fillable = [
        'bibit_id',
        'jumlah',
        'pelaksana',
        'lokasi',
        'keterangan',
        'foto',
        'tanggal',
        'inputed_by'
    ];

    public function bibit()
    {
        return $this->belongsTo(Bibit::class, 'bibit_id');
    }

    public static function getCustom()
    {
        $records = DB::table('penanaman')->select('pelaksana')->get();
        return $records;
    }
}
