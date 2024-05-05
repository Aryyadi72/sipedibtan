<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;
use App\Models\PermintaanMasuk;

class SummaryPermintaanBulanan
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        Carbon::setLocale('id');
        $now = Carbon::now()->tz('Asia/Jakarta');

        $currentMonth = $now->month;
        $currentYear = $now->year;

        $permintaanSelesaiMonth = PermintaanMasuk::where('status', 'Selesai')
            ->whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->count();

        $permintaanBatalMonth = PermintaanMasuk::where('status', 'Batal')
            ->whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->count();

        return $this->chart->barChart()
            ->setTitle('Summary Permintaan Bulanan')
            ->setSubtitle('Permintaan selesai dan batal pada bulan ' . $now->format('F'))
            ->addData('Permintaan Selesai', [$permintaanSelesaiMonth])
            ->addData('Permintaan Batal', [$permintaanBatalMonth])
            ->setXAxis([$now->format('F')]);
    }
}
