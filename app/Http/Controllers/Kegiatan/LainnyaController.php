<?php

namespace App\Http\Controllers\Kegiatan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kegiatan;
use Illuminate\Support\Facades\Storage;

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
        $request->validate([
            'kegiatan' => 'required',
            'pelaksana' => 'required',
            'lokasi' => 'required',
            'keterangan' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tanggal' => 'required',
            'inputed_by' => 'required',
        ]);

        if ($request->hasFile('foto')) {
            $imageName = time().'.'.$request->foto->extension();
            $request->foto->move(public_path('lainnya'), $imageName);
        } else {
            return redirect()->back()->withInput()->withErrors(['foto' => 'Foto harus diunggah.']);
        }

        Kegiatan::create([
            'kegiatan' => $request->kegiatan,
            'pelaksana' => $request->pelaksana,
            'lokasi' => $request->lokasi,
            'keterangan' => $request->keterangan,
            'foto' => $imageName,
            'tanggal' => $request->tanggal,
            'inputed_by' => $request->inputed_by,
        ]);

        return redirect()->route('lainnya.index')->with('success', 'Data pembagian berhasil disimpan.');
    }

    public function edit($id)
    {
        $title = "Kegiatan - Edit";
        $data = Kegiatan::findOrFail($id);
        $data = [
            'title' => $title,
            'data' => $data
        ];
        return view('manajemen-data.kegiatan.lainnya.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kegiatan' => 'required',
            'pelaksana' => 'required',
            'lokasi' => 'required',
            'keterangan' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'tanggal' => 'required|date',
            'inputed_by' => 'required',
        ]);

        $kegiatan = Kegiatan::findOrFail($id);

        if ($request->hasFile('foto')) {
            if ($kegiatan->foto) {
                Storage::delete($kegiatan->foto);
            }

            $imageName = time().'.'.$request->foto->extension();
            $request->foto->move(public_path('lainnya'), $imageName);
            $fotoName = $imageName;
        } else {
            $fotoName = $kegiatan->foto;
        }

        $kegiatan->update([
            'tanggal' => $request->tanggal,
            'kegiatan' => $request->kegiatan,
            'pelaksana' => $request->pelaksana,
            'lokasi' => $request->lokasi,
            'foto' => $fotoName,
            'inputed_by' => $request->inputed_by,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('lainnya.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $bibit = Kegiatan::find($id);

        $bibit->delete();

        return redirect()->route('lainnya.index');
    }
}
