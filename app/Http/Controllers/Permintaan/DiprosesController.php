<?php

namespace App\Http\Controllers\Permintaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DiprosesController extends Controller
{
    public function index()
    {
        $title = "Permintaan Diproses";
        $data = [
            'title' => $title
        ];
        return view('permintaan.diproses.index', $data);
    }

    public function create()
    {
        $title = "Permintaan Diproses - Tambah";
        $data = [
            'title' => $title
        ];
        return view('permintaan.diproses.create', $data);
    }


    public function edit()
    {
        $title = "Permintaan Diproses - Edit";
        $data = [
            'title' => $title
        ];
        return view('permintaan.diproses.edit', $data);
    }
}
