<?php

namespace App\Http\Controllers\Kegiatan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kegiatan;

class LainnyaController extends Controller
{
    public function index()
    {
        $title = "Kegiatan";
        $data = Kegiatan::all();
        $data = [
            'title' => $title,
            'data' => $data
        ];
        return view('manajemen-data.kegiatan.lainnya.index', $data);
    }

    public function create()
    {
        $title = "Kegiatan - Tambah";
        $data = [
            'title' => $title
        ];
        return view('manajemen-data.kegiatan.lainnya.create', $data);
    }

    public function store(Request $request)
    {
        Kegiatan::create([
            'kegiatan' => $request->kegiatan,
            'pelaksana' => $request->pelaksana,
            'lokasi' => $request->lokasi,
            'keterangan' => $request->keterangan,
            'foto' => $request->foto,
            'tanggal' => $request->tanggal,
            'inputed_by' => $request->inputed_by,
        ]);

        return redirect()->route('lainnya.index');
    }

    public function edit()
    {
        $title = "Kegiatan - Edit";
        $data = [
            'title' => $title
        ];
        return view('manajemen-data.kegiatan.lainnya.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $bibit = Kegiatan::find($id);
        $bibit->update([
            'kegiatan' => $request->kegiatan,
            'pelaksana' => $request->pelaksana,
            'lokasi' => $request->lokasi,
            'keterangan' => $request->keterangan,
            'foto' => $request->foto,
            'tanggal' => $request->tanggal,
            'inputed_by' => $request->inputed_by,
        ]);

        return redirect()->route('lainnya.index');
    }

    public function destroy($id)
    {
        $bibit = Kegiatan::find($id);

        $bibit->delete();

        return redirect()->route('lainnya.index');
    }
}
