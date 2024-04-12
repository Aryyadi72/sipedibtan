<?php

namespace App\Http\Controllers\Kegiatan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pembagian;

class PembagianController extends Controller
{
    public function index()
    {
        $title = "Pembagian";
        $data = Pembagian::all();
        $data = [
            'title' => $title,
            'data' => $data
        ];
        return view('manajemen-data.kegiatan.pembagian.index', $data);
    }

    public function create()
    {
        $title = "Pembagian - Tambah";
        $data = [
            'title' => $title
        ];
        return view('manajemen-data.kegiatan.pembagian.create', $data);
    }

    public function store(Request $request)
    {
        Pembagian::create([
            'bibit_id' => $request->bibit_id,
            'jumlah' => $request->jumlah,
            'lokasi' => $request->lokasi,
            'keterangan' => $request->keterangan,
            'koordinat' => $request->koordinat,
            'foto' => $request->foto,
            'tanggal' => $request->tanggal,
            'inputed_by' => $request->inputed_by,
        ]);

        return redirect()->route('pembagian.index');
    }

    public function edit()
    {
        $title = "Pembagian - Edit";
        $data = [
            'title' => $title
        ];
        return view('manajemen-data.kegiatan.pembagian.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $bibit = Pembagian::find($id);
        $bibit->update([
            'bibit_id' => $request->bibit_id,
            'jumlah' => $request->jumlah,
            'lokasi' => $request->lokasi,
            'keterangan' => $request->keterangan,
            'koordinat' => $request->koordinat,
            'foto' => $request->foto,
        ]);

        return redirect()->route('pembagian.index');
    }

    public function destroy($id)
    {
        $bibit = Pembagian::find($id);

        $bibit->delete();

        return redirect()->route('pembagian.index');
    }
}
