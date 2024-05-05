<?php

namespace App\Exports;

use App\Models\Penanaman;
use Maatwebsite\Excel\Concerns\FromCollection;

class PenanamanExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    // protected $startDate;

    // public function __construct($startDate)
    // {
    //     $this->startDate = $startDate;
    // }

    public function collection()
    {
        return Penanaman::pluck('pelaksana');

        // return Penanaman::getCustom();
    }
}
