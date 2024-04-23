<?php

namespace App\Http\Controllers\Kegiatan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pembagian;
use App\Models\Bibit;
use App\Models\BibitKeluar;
use App\Models\BibitMasuk;
use Illuminate\Support\Facades\Storage;

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
        $bibit = Bibit::all();
        $data = [
            'title' => $title,
            'bibit' => $bibit
        ];
        return view('manajemen-data.kegiatan.pembagian.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'bibit_id' => 'required',
            'jumlah' => 'required',
            'lokasi' => 'required',
            'keterangan' => 'required',
            'koordinat' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tanggal' => 'required',
            'inputed_by' => 'required',
        ]);

        if ($request->hasFile('foto')) {
            $imageName = time().'.'.$request->foto->extension();
            $request->foto->move(public_path('pembagian'), $imageName);
        } else {
            return redirect()->back()->withInput()->withErrors(['foto' => 'Foto harus diunggah.']);
        }

        BibitKeluar::create([
            'bibit_id' => $request->bibit_id,
            'jumlah' => $request->jumlah,
            'tanggal' => $request->tanggal,
            'inputed_by' => 'Admin',
            'keterangan' => 'Pembagian'
        ]);

        $bibitMasuk = BibitMasuk::where('bibit_id', $request->bibit_id)->first();
        if ($bibitMasuk) {
            $bibitMasuk->update([
                'stok' => $bibitMasuk->stok - $request->jumlah,
            ]);
        }

        Pembagian::create([
            'bibit_id' => $request->bibit_id,
            'jumlah' => $request->jumlah,
            'lokasi' => $request->lokasi,
            'keterangan' => $request->keterangan,
            'koordinat' => $request->koordinat,
            'foto' => $imageName,
            'tanggal' => $request->tanggal,
            'inputed_by' => $request->inputed_by,
        ]);

        return redirect()->route('pembagian.index')->with('success', 'Data pembagian berhasil disimpan.');
    }

    public function edit($id)
    {
        $title = "Pembagian - Edit";
        $bibit = Bibit::all();
        $data = Pembagian::findOrFail($id);
        $data = [
            'title' => $title,
            'bibit' => $bibit,
            'data' => $data
        ];
        return view('manajemen-data.kegiatan.pembagian.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'bibit_id' => 'required',
            'jumlah' => 'required',
            'lokasi' => 'required',
            'keterangan' => 'required',
            'koordinat' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'tanggal' => 'required',
            'inputed_by' => 'required',
        ]);

        $pembagian = Pembagian::findOrFail($id);

        if ($request->hasFile('foto')) {
            if ($pembagian->foto) {
                Storage::delete($pembagian->foto);
            }

            $imageName = time().'.'.$request->foto->extension();
            $request->foto->move(public_path('pembagian'), $imageName);
            $fotoName = $imageName;
        } else {
            $fotoName = $pembagian->foto;
        }

        $pembagian->update([
            'bibit_id' => $request->bibit_id,
            'jumlah' => $request->jumlah,
            'lokasi' => $request->lokasi,
            'keterangan' => $request->keterangan,
            'koordinat' => $request->koordinat,
            'foto' => $fotoName,
            'tanggal' => $request->tanggal,
            'inputed_by' => $request->inputed_by,
        ]);

        return redirect()->route('pembagian.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $bibit = Pembagian::find($id);

        $bibit->delete();

        return redirect()->route('pembagian.index');
    }
}
