<?php

namespace App\Http\Controllers\Kegiatan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pembagian;
use App\Models\Bibit;
use App\Models\BibitKeluar;
use App\Models\BibitMasuk;
use Illuminate\Support\Facades\Storage;
use DB;
use RealRashid\SweetAlert\Facades\Alert;

class PembagianController extends Controller
{
    public function index()
    {
        $title = "Pembagian";
        $data = Pembagian::all();
        $biodata = DB::table('biodata')->where('users_id', auth()->user()->id)->first();
        $data = [
            'title' => $title,
            'data' => $data,
            'biodata' => $biodata
        ];
        return view('manajemen-data.kegiatan.pembagian.index', $data);
    }

    public function create()
    {
        $title = "Pembagian - Tambah";
        $bibit = Bibit::all();
        $biodata = DB::table('biodata')->where('users_id', auth()->user()->id)->first();
        $data = [
            'title' => $title,
            'bibit' => $bibit,
            'biodata' => $biodata
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
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif',
            'tanggal' => 'required',
            'inputed_by' => 'required',
        ]);

        if ($request->hasFile('foto')) {
            $imageName = time() . '.' . $request->foto->extension();
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

        $pembagianAdd = Pembagian::create([
            'bibit_id' => $request->bibit_id,
            'jumlah' => $request->jumlah,
            'lokasi' => $request->lokasi,
            'keterangan' => $request->keterangan,
            'foto' => $imageName,
            'tanggal' => $request->tanggal,
            'inputed_by' => $request->inputed_by,
        ]);

        if (!$pembagianAdd) {
            Alert::error('Error!', 'Data pembagian gagal ditambahkan.');
            return back();
        } else {
            Alert::success('Success!', 'Data pembagian berhasil ditambahkan.');
            return redirect()->route('pembagian.index');
        }
    }

    public function edit($id)
    {
        $title = "Pembagian - Edit";
        $bibit = Bibit::all();
        $data = Pembagian::findOrFail($id);
        $biodata = DB::table('biodata')->where('users_id', auth()->user()->id)->first();
        $data = [
            'title' => $title,
            'bibit' => $bibit,
            'data' => $data,
            'biodata' => $biodata
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
            'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'tanggal' => 'required',
            'inputed_by' => 'required',
        ]);

        $pembagian = Pembagian::findOrFail($id);

        if ($request->hasFile('foto')) {
            if ($pembagian->foto) {
                Storage::delete($pembagian->foto);
            }

            $imageName = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('pembagian'), $imageName);
            $fotoName = $imageName;
        } else {
            $fotoName = $pembagian->foto;
        }

        $pembagianUp = $pembagian->update([
            'bibit_id' => $request->bibit_id,
            'jumlah' => $request->jumlah,
            'lokasi' => $request->lokasi,
            'keterangan' => $request->keterangan,
            'foto' => $fotoName,
            'tanggal' => $request->tanggal,
            'inputed_by' => $request->inputed_by,
        ]);

        if (!$pembagianUp) {
            Alert::error('Error!', 'Data pembagian gagal diperbarui.');
            return back();
        } else {
            Alert::success('Success!', 'Data pembagian berhasil diperbarui.');
            return redirect()->route('pembagian.index');
        }
    }

    public function destroy($id)
    {
        $bibit = Pembagian::find($id);

        $pembagianDel = $bibit->delete();

        if (!$pembagianDel) {
            Alert::error('Error!', 'Data pembagian gagal dihapus.');
            return back();
        } else {
            Alert::success('Success!', 'Data pembagian berhasil dihapus.');
            return redirect()->route('pembagian.index');
        }
    }

    public function filter(Request $request)
    {
        $title = "Pembagian - filter";
        $biodata = DB::table('biodata')->where('users_id', auth()->user()->id)->first();
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        $data = Pembagian::whereDate('pembagian.tanggal', '>=', $startDate)
            ->whereDate('pembagian.tanggal', '<=', $endDate)
            ->orderby('pembagian.tanggal', 'desc')->get();

        $data = [
            'title' => $title,
            'data' => $data,
            'biodata' => $biodata
        ];
        return view('manajemen-data.kegiatan.pembagian.index', $data);
    }
}
