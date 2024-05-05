<?php

namespace App\Http\Controllers;

use App\Models\PermintaanMasuk;
use Illuminate\Http\Request;
use DB;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Charts\SummaryPermintaan;
use App\Charts\SummaryPermintaanHarian;
use App\Charts\SummaryBibitHarian;
use App\Charts\SummaryBibitHarian2;
use App\Charts\SummaryPermintaanBulanan;
use App\Charts\SummaryBibitBulanan2;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $SummaryPermintaanHarian = new SummaryPermintaanHarian(new LarapexChart);
        $SummaryBibitHarian = new SummaryBibitHarian2(new LarapexChart);
        $SummaryPermintaanBulanan = new SummaryPermintaanBulanan(new LarapexChart);
        $SummaryBibitBulanan = new SummaryBibitBulanan2(new LarapexChart);

        $chartSPH = $SummaryPermintaanHarian->build();
        $chartSBH = $SummaryBibitHarian->build();
        $chartSPB = $SummaryPermintaanBulanan->build();
        $chartSBB = $SummaryBibitBulanan->build();

        $title = "Dashboard - SIPEDIBTAN";
        $biodata = DB::table('biodata')->where('users_id', auth()->user()->id)->first();

        $dateNow = Carbon::now()->format('Y-m-d');
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        $permintaanTotal = PermintaanMasuk::whereDate('created_at', $dateNow)->count();

        $permintaanSelesai = PermintaanMasuk::where('status', 'Selesai')
            ->whereDate('created_at', $dateNow)
            ->count();

        $permintaanBatal = PermintaanMasuk::where('status', 'Batal')
            ->whereDate('created_at', $dateNow)
            ->count();

        $permintaanTotalMonth = PermintaanMasuk::whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->count();

        $permintaanSelesaiMonth = PermintaanMasuk::where('status', 'Selesai')
            ->whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->count();

        $permintaanBatalMonth = PermintaanMasuk::where('status', 'Batal')
            ->whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->count();

        $data = [
            'title' => $title,
            'biodata' => $biodata,
            'chartSPH' => $chartSPH,
            'chartSBH' => $chartSBH,
            'chartSPB' => $chartSPB,
            'chartSBB' => $chartSBB,
            'permintaanTotal' => $permintaanTotal,
            'permintaanSelesai' => $permintaanSelesai,
            'permintaanBatal' => $permintaanBatal,
            'permintaanTotalMonth' => $permintaanTotalMonth,
            'permintaanSelesaiMonth' => $permintaanSelesaiMonth,
            'permintaanBatalMonth' => $permintaanBatalMonth
        ];
        return view('dashboard', $data);
    }
}
