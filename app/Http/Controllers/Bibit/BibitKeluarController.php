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
        $data = BibitKeluar::all();
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

}
