<?php

namespace App\Http\Controllers\Kegiatan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penanaman;

class PenanamanController extends Controller
{
    public function index()
    {
        $title = "Penanaman";
        $data = Penanaman::all();
        $data = [
            'title' => $title,
            'data' => $data
        ];
        return view('manajemen-data.kegiatan.penanaman.index', $data);
    }

    public function create()
    {
        $title = "Penanaman - Tambah";
        $data = [
            'title' => $title
        ];
        return view('manajemen-data.kegiatan.penanaman.create', $data);
    }

    public function store(Request $request)
    {
        Penanaman::create([
            'bibit_id' => $request->bibit_id,
            'jumlah' => $request->jumlah,
            'pelaksana' => $request->pelaksana,
            'lokasi' => $request->lokasi,
            'keterangan' => $request->keterangan,
            'koordinat' => $request->koordinat,
            'foto' => $request->foto,
            'tanggal' => $request->tanggal,
            'inputed_by' => $request->inputed_by,
        ]);

        return redirect()->route('penanaman.index');
    }

    public function edit()
    {
        $title = "Penanaman - Edit";
        $data = [
            'title' => $title
        ];
        return view('manajemen-data.kegiatan.penanaman.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $bibit = Penanaman::find($id);
        $bibit->update([
            'bibit_id' => $request->bibit_id,
            'jumlah' => $request->jumlah,
            'pelaksana' => $request->pelaksana,
            'lokasi' => $request->lokasi,
            'keterangan' => $request->keterangan,
            'koordinat' => $request->koordinat,
            'foto' => $request->foto,
        ]);

        return redirect()->route('penanaman.index');
    }

    public function destroy($id)
    {
        $bibit = Penanaman::find($id);

        $bibit->delete();

        return redirect()->route('penanaman.index');
    }
}
