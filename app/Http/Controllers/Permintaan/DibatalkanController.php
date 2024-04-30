<?php

namespace App\Http\Controllers\Permintaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PermintaanMasuk;
use App\Models\PermintaanKeluar;
use DB;

class DibatalkanController extends Controller
{
    public function index()
    {
        $title = "Permintaan Dibatalkan - SIPEDIBTAN";
        $biodata = DB::table('biodata')->where('users_id', auth()->user()->id)->first();
        $datapb = DB::table('permintaan_keluar')
            ->join('users', 'permintaan_keluar.users_id', '=', 'users.id')
            ->join('permintaan_masuk', 'permintaan_keluar.permintaan_masuk_id', '=', 'permintaan_masuk.id')
            ->join('bibit', 'permintaan_masuk.bibit_id', '=', 'bibit.id')
            ->join('biodata', 'users.id', '=', 'biodata.users_id')
            ->select('permintaan_keluar.*', 'permintaan_masuk.*', 'bibit.*', 'users.*', 'biodata.*', 'permintaan_keluar.id as keluar_id', 'permintaan_keluar.created_at as keluar_tgl')
            ->where('permintaan_masuk.status', 'Batal')
            ->orderby('permintaan_keluar.created_at', 'desc')
            ->get();
        $data = [
            'title' => $title,
            'biodata' => $biodata,
            'datapb' => $datapb
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

    public function store($id)
    {
        $permintaanMasuk = PermintaanMasuk::findOrFail($id);

        $permintaanKeluar = new PermintaanKeluar();
        $permintaanKeluar->fill([
            'permintaan_masuk_id' => $permintaanMasuk->id,
            'users_id' => $permintaanMasuk->users_id,
        ]);
        $permintaanKeluar->save();

        $permintaanMasuk->update(['status' => 'Batal']);

        return redirect()->route('keluar.index')->with('success', 'Data penanaman berhasil disimpan.');
    }
}
