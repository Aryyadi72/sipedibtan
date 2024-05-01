<?php

namespace App\Http\Controllers\Bibit;

use App\Http\Controllers\Controller;
use App\Models\BibitKeluar;
use Illuminate\Http\Request;
use DB;

class BibitKeluarController extends Controller
{
    public function index()
    {
        $title = "Bibit Keluar";
        $data = BibitKeluar::orderby('bibit_keluar.tanggal', 'desc')->get();
        $biodata = DB::table('biodata')->where('users_id', auth()->user()->id)->first();
        $data = [
            'title' => $title,
            'data' => $data,
            'biodata' => $biodata
        ];
        return view('manajemen-data.bibit.bibit-keluar.index', $data);
    }

    public function create()
    {
        $title = "Bibit Keluar - Tambah";
        $data = [
            'title' => $title
        ];
        return view('manajemen-data.bibit.bibit-keluar.create', $data);
    }

    public function edit()
    {
        $title = "Bibit Keluar - Edit";
        $data = [
            'title' => $title
        ];
        return view('manajemen-data.bibit.bibit-keluar.edit', $data);
    }

    public function filter(Request $request)
    {
        $title = "Bibit Keluar";
        $biodata = DB::table('biodata')->where('users_id', auth()->user()->id)->first();
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        $data = BibitKeluar::whereDate('bibit_keluar.created_at', '>=', $startDate)
            ->whereDate('bibit_keluar.created_at', '<=', $endDate)
            ->orderby('bibit_keluar.created_at', 'desc')->get();

        $data = [
            'title' => $title,
            'data' => $data,
            'biodata' => $biodata
        ];
        return view('manajemen-data.bibit.bibit-keluar.index', $data);
    }

}
