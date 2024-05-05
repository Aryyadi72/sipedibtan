<?php

namespace App\Charts;

use App\Models\BibitKeluar;
use App\Models\BibitMasuk;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;
use DB;

class SummaryBibitHarian
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        Carbon::setLocale('id');
        $date = Carbon::now()->translatedFormat('l, d-m-Y');
        $dateNow = Carbon::now()->format('Y-m-d');

        $bibitMasuk = DB::table('bibit_masuk')->whereDate('created_at', $dateNow)->sum('stok');

        $bibitKeluar = DB::table('bibit_keluar')->whereDate('tanggal', $dateNow)->sum('jumlah');

        // return $this->chart->pieChart()
        //     ->setTitle('Summary Bibit Masuk & Keluar')
        //     ->setSubtitle($date)
        //     ->addData([$bibitMasuk, $bibitKeluar])
        //     ->setColors(['#000080', '#FFD700'])
        //     ->setLabels(['Bibit Masuk', 'Bibit Keluar']);

        return $this->chart->radialChart()
            ->setTitle('Summary Bibit Masuk & Keluar')
            ->setSubtitle($date)
            ->addData([$bibitMasuk, $bibitKeluar])
            ->setColors(['#000080', '#FFD700'])
            ->setLabels(['Bibit Masuk', 'Bibit Keluar']);
    }
}
