<?php

namespace App\Http\Controllers\Kegiatan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penanaman;
use App\Models\Bibit;
use Illuminate\Support\Facades\Storage;
use App\Models\BibitMasuk;
use App\Models\BibitKeluar;

class PenanamanController extends Controller
{
    public function index()
    {
        $title = "Penanaman";
        $data = Penanaman::all();
        $data = [
            'title' => $title,
            'data' => $data,
        ];
        return view('manajemen-data.kegiatan.penanaman.index', $data);
    }

    public function create()
    {
        $title = "Penanaman - Tambah";
        $bibit = Bibit::all();
        $data = [
            'title' => $title,
            'bibit' => $bibit
        ];
        return view('manajemen-data.kegiatan.penanaman.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'bibit_id' => 'required',
            'jumlah' => 'required',
            'pelaksana' => 'required',
            'lokasi' => 'required',
            'keterangan' => 'required',
            'koordinat' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tanggal' => 'required',
            'inputed_by' => 'required',
        ]);

        if ($request->hasFile('foto')) {
            $imageName = time().'.'.$request->foto->extension();
            $request->foto->move(public_path('images'), $imageName);
        } else {
            return redirect()->back()->withInput()->withErrors(['foto' => 'Foto harus diunggah.']);
        }

        BibitKeluar::create([
            'bibit_id' => $request->bibit_id,
            'jumlah' => $request->jumlah,
            'tanggal' => $request->tanggal,
            'inputed_by' => 'Admin',
            'keterangan' => 'Penanaman'
        ]);

        $bibitMasuk = BibitMasuk::where('bibit_id', $request->bibit_id)->first();
        if ($bibitMasuk) {
            $bibitMasuk->update([
                'stok' => $bibitMasuk->stok - $request->jumlah,
            ]);
        }

        Penanaman::create([
            'bibit_id' => $request->bibit_id,
            'jumlah' => $request->jumlah,
            'pelaksana' => $request->pelaksana,
            'lokasi' => $request->lokasi,
            'keterangan' => $request->keterangan,
            'koordinat' => $request->koordinat,
            'foto' => $imageName,
            'tanggal' => $request->tanggal,
            'inputed_by' => $request->inputed_by,
        ]);

        return redirect()->route('penanaman.index')->with('success', 'Data penanaman berhasil disimpan.');
    }

    public function edit($id)
    {
        $title = "Penanaman - Edit";
        $data = Penanaman::findOrFail($id);
        $bibit = Bibit::all();
        $data = [
            'title' => $title,
            'data' => $data,
            'bibit' => $bibit
        ];
        return view('manajemen-data.kegiatan.penanaman.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'bibit_id' => 'required',
            'jumlah' => 'required',
            'pelaksana' => 'required',
            'lokasi' => 'required',
            'keterangan' => 'required',
            'koordinat' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'tanggal' => 'required',
            'inputed_by' => 'required',
        ]);

        $penanaman = Penanaman::findOrFail($id);

        if ($request->hasFile('foto')) {
            if ($penanaman->foto) {
                Storage::delete($penanaman->foto);
            }

            $imageName = time().'.'.$request->foto->extension();
            $request->foto->move(public_path('images'), $imageName);
            $fotoName = $imageName;
        } else {
            $fotoName = $penanaman->foto;
        }

        $penanaman->update([
            'bibit_id' => $request->bibit_id,
            'jumlah' => $request->jumlah,
            'pelaksana' => $request->pelaksana,
            'lokasi' => $request->lokasi,
            'keterangan' => $request->keterangan,
            'koordinat' => $request->koordinat,
            'foto' => $fotoName,
            'tanggal' => $request->tanggal,
            'inputed_by' => $request->inputed_by,
        ]);

        return redirect()->route('penanaman.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $penanaman = Penanaman::findOrFail($id);

        if ($penanaman->foto) {
            Storage::delete('images/' . $penanaman->foto);
        }

        $penanaman->delete();

        return redirect()->route('penanaman.index')->with('success', 'Data penanaman berhasil dihapus.');
    }
}
