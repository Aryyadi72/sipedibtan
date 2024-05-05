<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bibit;
use DB;

class LandingController extends Controller
{
    public function index()
    {
        // $bibit = Bibit::orderby('bibit.bibit', 'asc')->get();
        $bibit = DB::table('bibit')
            ->leftJoin('bibit_masuk', 'bibit.id', '=', 'bibit_masuk.bibit_id')
            ->select('bibit.*', 'bibit.id as bibitid', DB::raw('COALESCE(SUM(bibit_masuk.stok), 0) as total_jumlah'))
            ->groupBy('bibit.id', 'bibit.bibit')
            ->orderby('bibit.bibit', 'asc')
            ->get();
        $bibitTersedia = DB::table('bibit')
            ->leftJoin('bibit_masuk', 'bibit.id', '=', 'bibit_masuk.bibit_id')
            ->select('bibit.*', 'bibit.id as bibitid', DB::raw('COALESCE(SUM(bibit_masuk.stok), 0) as total_jumlah'))
            ->where('bibit_masuk.stok', '>', 0)
            ->groupBy('bibit.id', 'bibit.bibit')
            ->orderby('bibit.bibit', 'asc')
            ->get();
        $bibitTidakTersedia = DB::table('bibit')
            ->leftJoin('bibit_masuk', 'bibit.id', '=', 'bibit_masuk.bibit_id')
            ->select('bibit.*', 'bibit.id as bibitid', DB::raw('COALESCE(SUM(bibit_masuk.stok), 0) as total_jumlah'))
            ->where('bibit_masuk.stok', null)
            ->groupBy('bibit.id', 'bibit.bibit')
            ->orderby('bibit.bibit', 'asc')
            ->get();
        $data = [
            'bibit' => $bibit,
            'bibitTersedia' => $bibitTersedia,
            'bibitTidakTersedia' => $bibitTidakTersedia
        ];
        return view('landing', $data);
    }
}
