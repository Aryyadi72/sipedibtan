<?php

namespace App\Http\Controllers\Permintaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PermintaanKeluar;
use App\Models\PermintaanMasuk;
use App\Models\BibitMasuk;
use DB;

class KeluarController extends Controller
{
    public function index()
    {
        $title = "Permintaan Keluar - SIPEDIBTAN";
        $biodata = DB::table('biodata')->where('users_id', auth()->user()->id)->first();
        $datapk = DB::table('permintaan_keluar')
            ->join('users', 'permintaan_keluar.users_id', '=', 'users.id')
            ->join('permintaan_masuk', 'permintaan_keluar.permintaan_masuk_id', '=', 'permintaan_masuk.id')
            ->join('bibit', 'permintaan_masuk.bibit_id', '=', 'bibit.id')
            ->join('biodata', 'users.id', '=', 'biodata.users_id')
            ->select('permintaan_keluar.*', 'permintaan_masuk.*', 'bibit.*', 'users.*', 'biodata.*', 'permintaan_keluar.id as keluar_id', 'permintaan_keluar.created_at as keluar_tgl')
            ->where('permintaan_masuk.status', 'Selesai')
            ->get();
        $data = [
            'title' => $title,
            'biodata' => $biodata,
            'datapk' => $datapk

        ];
        return view('permintaan.keluar.index', $data);
    }

    public function create()
    {
        $title = "Permintaan Keluar - Tambah";
        $data = [
            'title' => $title
        ];
        return view('permintaan.keluar.create', $data);
    }


    public function edit()
    {
        $title = "Permintaan Keluar - Edit";
        $data = [
            'title' => $title
        ];
        return view('permintaan.keluar.edit', $data);
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

        $bibitMasuk = BibitMasuk::where('bibit_id', $permintaanMasuk->bibit_id)->first();
        if ($bibitMasuk) {
            $bibitMasuk->update([
                'stok' => $bibitMasuk->stok - $permintaanMasuk->jumlah,
            ]);
        }

        $permintaanMasuk->update(['status' => 'Selesai']);

        return redirect()->route('keluar.index')->with('success', 'Data penanaman berhasil disimpan.');
    }
}
