<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;
use DB;

class SummaryBibitBulanan
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        Carbon::setLocale('id');
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        $bibitMasuk = DB::table('bibit_masuk')
            ->whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->sum('stok');

        $bibitKeluar = DB::table('bibit_keluar')
            ->whereYear('tanggal', $currentYear)
            ->whereMonth('tanggal', $currentMonth)
            ->sum('jumlah');

        return $this->chart->barChart()
            ->setTitle('Summary Bibit Masuk & Keluar Bulanan')
            ->setSubtitle('Wins during season 2021.')
            ->addData('Bibit Masuk', [$bibitMasuk])
            ->addData('Bibit Keluar', [$bibitKeluar])
            ->setXAxis([Carbon::now()->format('F')]);
    }
}
