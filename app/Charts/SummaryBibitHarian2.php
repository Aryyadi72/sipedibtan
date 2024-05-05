<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use DB;
use Carbon\Carbon;

class SummaryBibitHarian2
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\RadialChart
    {
        Carbon::setLocale('id');
        $now = Carbon::now()->tz('Asia/Jakarta');

        $date = $now->translatedFormat('l, d-m-Y');
        $dateNow = $now->format('Y-m-d');

        $bibitMasuk = DB::table('bibit_masuk')->whereDate('created_at', $dateNow)->sum('stok');

        $bibitKeluar = DB::table('bibit_keluar')->whereDate('tanggal', $dateNow)->sum('jumlah');

        return $this->chart->radialChart()
            ->setTitle('Summary Bibit Masuk & Keluar')
            ->setSubtitle($date)
            ->addData([$bibitMasuk, $bibitKeluar])
            ->setColors(['#000080', '#FFD700'])
            ->setLabels(['Bibit Masuk', 'Bibit Keluar']);
    }
}
