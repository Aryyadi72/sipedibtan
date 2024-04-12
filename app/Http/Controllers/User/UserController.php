<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $title = "User";
        $data = [
            'title' => $title
        ];
        return view('manajemen-data.user.user.index', $data);
    }

    public function create()
    {
        $title = "User - Tambah";
        $data = [
            'title' => $title
        ];
        return view('manajemen-data.user.user.create', $data);
    }


    public function edit()
    {
        $title = "User - Edit";
        $data = [
            'title' => $title
        ];
        return view('manajemen-data.user.user.edit', $data);
    }
}
