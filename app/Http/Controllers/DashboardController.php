<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DashboardController extends Controller
{
    public function index()
    {
        $title = "Dashboard - SIPEDIBTAN";
        $biodata = DB::table('biodata')->where('users_id', auth()->user()->id)->first();
        $data = [
            'title' => $title,
            'biodata' => $biodata
        ];
        return view('dashboard', $data);
    }
}
