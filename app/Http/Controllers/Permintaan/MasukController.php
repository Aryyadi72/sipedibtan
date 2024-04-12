<?php

namespace App\Http\Controllers\Permintaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MasukController extends Controller
{
    public function index()
    {
        $title = "Permintaan Masuk";
        $data = [
            'title' => $title
        ];
        return view('permintaan.masuk.index', $data);
    }

    public function create()
    {
        $title = "Permintaan Masuk - Tambah";
        $data = [
            'title' => $title
        ];
        return view('permintaan.masuk.create', $data);
    }


    public function edit()
    {
        $title = "Permintaan Masuk - Edit";
        $data = [
            'title' => $title
        ];
        return view('permintaan.masuk.edit', $data);
    }
}
