<?php

namespace App\Http\Controllers\Permintaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DibatalkanController extends Controller
{
    public function index()
    {
        $title = "Permintaan Dibatalkan";
        $data = [
            'title' => $title
        ];
        return view('permintaan.ditolak.index', $data);
    }

    public function create()
    {
        $title = "Permintaan Dibatalkan - Tambah";
        $data = [
            'title' => $title
        ];
        return view('permintaan.ditolak.create', $data);
    }


    public function edit()
    {
        $title = "Permintaan Dibatalkan - Edit";
        $data = [
            'title' => $title
        ];
        return view('permintaan.ditolak.edit', $data);
    }
}
