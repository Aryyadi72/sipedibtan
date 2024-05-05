<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\Pembagian;
use App\Models\Penanaman;
use Carbon\Carbon;

class PenanamanPembagianExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */

    private function translateMonthToEnglish($namaBulan)
    {
        $monthNamesIndo = [
            'Januari' => 'January',
            'Februari' => 'February',
            'Maret' => 'March',
            'April' => 'April',
            'Mei' => 'May',
            'Juni' => 'June',
            'Juli' => 'July',
            'Agustus' => 'August',
            'September' => 'September',
            'Oktober' => 'October',
            'November' => 'November',
            'Desember' => 'December',
        ];

        return $monthNamesIndo[$namaBulan] ?? $namaBulan;
    }

    public function view(): View
    {
        $tahun = request()->input('tahun');

        $namaBulan = request()->input('bulan');
        $englishMonth = $this->translateMonthToEnglish($namaBulan);
        $bulan = date('m', strtotime($englishMonth));

        $startDate = Carbon::createFromDate($tahun, $bulan, 1)->startOfMonth();
        $endDate = $startDate->copy()->endOfMonth();

        $dataPenanaman = Penanaman::whereBetween('tanggal', [$startDate, $endDate])->get();
        $dataPembagian = Pembagian::whereBetween('tanggal', [$startDate, $endDate])->get();

        return view('manajemen-data.kegiatan.penanaman.export', [
            'dataPenanaman' => $dataPenanaman,
            'dataPembagian' => $dataPembagian,
            'tahun' => $tahun
        ]);
    }
}
