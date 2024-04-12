<?php

namespace App\Http\Controllers\Permintaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KeluarController extends Controller
{
    public function index()
    {
        $title = "Permintaan Keluar";
        $data = [
            'title' => $title
        ];
        return view('permintaan.keluar.index', $data);
    }

    public function create()
    {
        $title = "Permintaan Keluar - Tambah";
        $data = [
            'title' => $title
        ];
        return view('permintaan.keluar.create', $data);
    }


    public function edit()
    {
        $title = "Permintaan Keluar - Edit";
        $data = [
            'title' => $title
        ];
        return view('permintaan.keluar.edit', $data);
    }
}
