<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;
use DB;

class SummaryBibitBulanan2
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\HorizontalBar
    {
        Carbon::setLocale('id');
        $now = Carbon::now()->tz('Asia/Jakarta');

        $currentMonth = $now->month;
        $currentYear = $now->year;

        $bibitMasuk = DB::table('bibit_masuk')
            ->whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->sum('stok');

        $bibitKeluar = DB::table('bibit_keluar')
            ->whereYear('tanggal', $currentYear)
            ->whereMonth('tanggal', $currentMonth)
            ->sum('jumlah');

        return $this->chart->horizontalBarChart()
            ->setTitle('Summary Bibit Masuk & Keluar Bulanan')
            ->setSubtitle('Bibit Masuk dan Keluar pada bulan ' . $now->format('F'))
            ->addData('Bibit Masuk', [$bibitMasuk])
            ->addData('Bibit Keluar', [$bibitKeluar])
            ->setXAxis([$now->format('F')]);
    }
}
