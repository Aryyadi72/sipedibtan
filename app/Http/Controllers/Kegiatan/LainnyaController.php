<?php

namespace App\Http\Controllers\Kegiatan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kegiatan;
use Illuminate\Support\Facades\Storage;
use DB;
use RealRashid\SweetAlert\Facades\Alert;

class LainnyaController extends Controller
{
    public function index()
    {
        $title = "Kegiatan";
        $data = Kegiatan::all();
        $biodata = DB::table('biodata')->where('users_id', auth()->user()->id)->first();
        $data = [
            'title' => $title,
            'data' => $data,
            'biodata' => $biodata
        ];
        return view('manajemen-data.kegiatan.lainnya.index', $data);
    }

    public function create()
    {
        $title = "Kegiatan - Tambah";
        $biodata = DB::table('biodata')->where('users_id', auth()->user()->id)->first();
        $data = [
            'title' => $title,
            'biodata' => $biodata
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
            $imageName = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('lainnya'), $imageName);
        } else {
            return redirect()->back()->withInput()->withErrors(['foto' => 'Foto harus diunggah.']);
        }

        $kegiatanAdd = Kegiatan::create([
            'kegiatan' => $request->kegiatan,
            'pelaksana' => $request->pelaksana,
            'lokasi' => $request->lokasi,
            'keterangan' => $request->keterangan,
            'foto' => $imageName,
            'tanggal' => $request->tanggal,
            'inputed_by' => $request->inputed_by,
        ]);

        if (!$kegiatanAdd) {
            Alert::error('Error!', 'Data kegiatan gagal ditambahkan.');
            return back();
        } else {
            Alert::success('Success!', 'Data kegiatan berhasil ditambahkan.');
            return redirect()->route('lainnya.index');
        }
    }

    public function edit($id)
    {
        $title = "Kegiatan - Edit";
        $data = Kegiatan::findOrFail($id);
        $biodata = DB::table('biodata')->where('users_id', auth()->user()->id)->first();
        $data = [
            'title' => $title,
            'data' => $data,
            'biodata' => $biodata
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

            $imageName = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('lainnya'), $imageName);
            $fotoName = $imageName;
        } else {
            $fotoName = $kegiatan->foto;
        }

        $kegiatanUp = $kegiatan->update([
            'tanggal' => $request->tanggal,
            'kegiatan' => $request->kegiatan,
            'pelaksana' => $request->pelaksana,
            'lokasi' => $request->lokasi,
            'foto' => $fotoName,
            'inputed_by' => $request->inputed_by,
            'keterangan' => $request->keterangan,
        ]);

        if (!$kegiatanUp) {
            Alert::error('Error!', 'Data kegiatan gagal diubah.');
            return back();
        } else {
            Alert::success('Success!', 'Data kegiatan berhasil diubah.');
            return redirect()->route('lainnya.index');
        }
    }

    public function destroy($id)
    {
        $bibit = Kegiatan::find($id);

        $kegiatanDel = $bibit->delete();

        if (!$kegiatanDel) {
            Alert::error('Error!', 'Data kegiatan gagal dihapus.');
            return back();
        } else {
            Alert::success('Success!', 'Data kegiatan berhasil dihapus.');
            return redirect()->route('lainnya.index');
        }
    }

    public function filter(Request $request)
    {
        $title = "Kegiatan - filter";
        $biodata = DB::table('biodata')->where('users_id', auth()->user()->id)->first();
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        $data = Kegiatan::whereDate('kegiatan.tanggal', '>=', $startDate)
            ->whereDate('kegiatan.tanggal', '<=', $endDate)
            ->orderby('kegiatan.tanggal', 'desc')->get();

        $data = [
            'title' => $title,
            'data' => $data,
            'biodata' => $biodata
        ];
        return view('manajemen-data.kegiatan.lainnya.index', $data);
    }
}
