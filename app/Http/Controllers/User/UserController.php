<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Biodata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $title = "User";
        $data = DB::table('users')
            ->join('biodata', 'users.id', '=', 'biodata.users_id')
            ->select('users.id as id_user', 'users.*', 'biodata.nama as nama_biodata')
            ->get();
        $data = [
            'title' => $title,
            'data' => $data
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

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'level' => 'required',
            'inputed_by' => 'required',
        ]);

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level' => $request->level,
            'inputed_by' => $request->inputed_by,
        ]);

        Biodata::create([
            'nama' => $request->nama,
            'users_id' => $user->id,
        ]);

        return redirect()->route('user.index')->with('success', 'Data pengguna berhasil disimpan.');
    }


    public function edit()
    {
        $title = "User - Edit";
        $data = [
            'title' => $title
        ];
        return view('manajemen-data.user.user.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'email' => 'required|unique:users,email,' . $id,
            'password' => 'nullable',
            'level' => 'required',
        ]);

        $user = User::findOrFail($id);

        $userData = [
            'email' => $request->email,
            'level' => $request->level,
        ];

        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        $user->update($userData);

        return redirect()->route('user.index')->with('success', 'Data pengguna berhasil diperbarui.');
    }
}
