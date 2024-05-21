<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Biodata;
use Illuminate\Http\Request;
use DB;
use RealRashid\SweetAlert\Facades\Alert;

class BiodataController extends Controller
{
    public function index()
    {
        $title = "Biodata Pengguna";

        $user = auth()->user()->level;

        if ($user == 'Petugas') {
            $data = DB::table('biodata')
                ->join('users', 'biodata.users_id', 'users.id')
                ->select('biodata.*', 'biodata.id as bioid')
                ->where('users.level', 'Masyarakat')
                ->get();
        } else {
            $data = DB::table('biodata')
                ->join('users', 'biodata.users_id', 'users.id')
                ->select('biodata.*', 'biodata.id as bioid')
                ->get();
        }

        $biodata = DB::table('biodata')->where('users_id', auth()->user()->id)->first();

        $data = [
            'title' => $title,
            'data' => $data,
            'biodata' => $biodata
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


    public function edit($id)
    {
        $title = "Biodata Pengguna - Edit";
        $data = Biodata::findOrFail($id);
        $biodata = DB::table('biodata')->where('users_id', auth()->user()->id)->first();
        $data = [
            'title' => $title,
            'data' => $data,
            'biodata' => $biodata
        ];
        return view('manajemen-data.user.biodata-user.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $user = auth()->user();
        $level = $user->level;

        $request->validate([
            'nama' => 'required',
            'no_ktp' => 'required|numeric|unique:biodata,no_ktp,' . $id,
        ]);

        $biodata = Biodata::findOrFail($id);

        $biodata->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
            'umur' => $request->umur,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'no_ktp' => $request->no_ktp,
            'no_telpon' => $request->no_telpon,
            'pendidikan' => $request->pendidikan,
            'agama' => $request->agama,
            'domisili' => $request->domisili,
        ]);

        if ($level == 'Masyarakat') {
            Alert::success('Success!', 'Data biodata berhasil diperbarui.');
            return redirect()->route('masuk.index');
        } else {
            Alert::success('Success!', 'Data biodata berhasil diperbarui.');
            return redirect()->route('biodata.index');
        }
    }

    public function detail($id)
    {
        $title = "Biodata Pengguna - Detail";
        $data = Biodata::findOrFail($id);
        $biodata = DB::table('biodata')->where('users_id', auth()->user()->id)->first();
        $data = [
            'title' => $title,
            'data' => $data,
            'biodata' => $biodata
        ];
        return view('manajemen-data.user.biodata-user.detail', $data);
    }

}
