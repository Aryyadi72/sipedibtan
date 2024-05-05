<?php

namespace App\Charts;

use App\Models\PermintaanMasuk;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;
use Carbon\CarbonInterface;

class SummaryPermintaanHarian
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        Carbon::setLocale('id');
        // Carbon::setTimezone('Asia/Jakarta');
        $now = Carbon::now()->tz('Asia/Jakarta');

        $date = $now->translatedFormat('l, d-m-Y');
        $dateNow = $now->format('Y-m-d');

        $permintaanSelesai = PermintaanMasuk::where('status', 'Selesai')
            ->whereDate('created_at', $dateNow)
            ->count();

        $permintaanBatal = PermintaanMasuk::where('status', 'Batal')
            ->whereDate('created_at', $dateNow)
            ->count();

        return $this->chart->pieChart()
            ->setTitle('Summary Permintaan Harian')
            ->setSubtitle($date)
            ->addData([$permintaanSelesai, $permintaanBatal])
            ->setColors(['#00FF00', '#FF0000'])
            ->setLabels(['Selesai', 'Batal']);
    }
}
