<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BiodataController extends Controller
{
    public function index()
    {
        $title = "Biodata Pengguna";
        $data = [
            'title' => $title
        ];
        return view('manajemen-data.user.biodata-user.index', $data);
    }

    public function create()
    {
        $title = "Biodata Pengguna - Tambah";
        $data = [
            'title' => $title
        ];
        return view('manajemen-data.user.biodata-user.create', $data);
    }


    public function edit()
    {
        $title = "Biodata Pengguna - Edit";
        $data = [
            'title' => $title
        ];
        return view('manajemen-data.user.biodata-user.edit', $data);
    }
}
