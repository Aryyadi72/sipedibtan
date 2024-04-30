<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Biodata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function index()
    {
        $title = "User";
        $data = DB::table('users')
            ->join('biodata', 'users.id', '=', 'biodata.users_id')
            ->select('users.id as id_user', 'users.*', 'biodata.nama as nama_biodata')
            ->get();
        $biodata = DB::table('biodata')->where('users_id', auth()->user()->id)->first();
        $data = [
            'title' => $title,
            'data' => $data,
            'biodata' => $biodata
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
        $level = auth()->user()->level;

        $request->validate([
            'nama' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'level' => 'required',
        ]);

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level' => $request->level,
            'inputed_by' => $level,
        ]);

        Biodata::create([
            'nama' => $request->nama,
            'users_id' => $user->id,
        ]);

        if ($user) {
            Alert::success('Success!', 'Data user berhasil ditambahkan.');
            return redirect()->route('user.index');
        } else {
            Alert::success('Success!', 'Data user gagal ditambahkan.');
            return back();
        }
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

        $userUp = $user->update($userData);

        if ($userUp) {
            Alert::success('Success!', 'Data user berhasil diperbarui.');
            return redirect()->route('user.index');
        } else {
            Alert::success('Success!', 'Data user gagal diperbarui.');
            return back();
        }
    }

    public function destroy($id)
    {
        $user = User::find($id);

        $userDelete = $user->delete();

        if ($userDelete) {
            Alert::success('Success!', 'Data user berhasil dihapus.');
            return redirect()->route('user.index');
        } else {
            Alert::error('Error!', 'Data user gagal dihapus.');
            return redirect()->route('user.index');
        }
    }
}
