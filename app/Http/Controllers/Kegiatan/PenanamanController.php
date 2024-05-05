<?php

namespace App\Http\Controllers\Kegiatan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penanaman;
use App\Models\Pembagian;
use App\Models\Bibit;
use Illuminate\Support\Facades\Storage;
use App\Models\BibitMasuk;
use App\Models\BibitKeluar;
use DB;
use RealRashid\SweetAlert\Facades\Alert;
use App\Exports\PenanamanPembagianExport;
use App\Exports\PenanamanExport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class PenanamanController extends Controller
{
    public function index()
    {
        $title = "Penanaman";
        $data = Penanaman::all();
        $biodata = DB::table('biodata')->where('users_id', auth()->user()->id)->first();
        $data = [
            'title' => $title,
            'data' => $data,
            'biodata' => $biodata
        ];
        return view('manajemen-data.kegiatan.penanaman.index', $data);
    }

    public function create()
    {
        $title = "Penanaman - Tambah";
        $bibit = Bibit::all();
        $biodata = DB::table('biodata')->where('users_id', auth()->user()->id)->first();
        $data = [
            'title' => $title,
            'bibit' => $bibit,
            'biodata' => $biodata
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
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif',
            'tanggal' => 'required',
            'inputed_by' => 'required',
        ]);

        if ($request->hasFile('foto')) {
            $imageName = time() . '.' . $request->foto->extension();
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

        $penanamanAdd = Penanaman::create([
            'bibit_id' => $request->bibit_id,
            'jumlah' => $request->jumlah,
            'pelaksana' => $request->pelaksana,
            'lokasi' => $request->lokasi,
            'keterangan' => $request->keterangan,
            'foto' => $imageName,
            'tanggal' => $request->tanggal,
            'inputed_by' => $request->inputed_by,
        ]);

        if (!$penanamanAdd) {
            Alert::error('Error!', 'Data penanaman gagal ditambahkan.');
            return back();
        } else {
            Alert::success('Success!', 'Data penanaman berhasil ditambahkan.');
            return redirect()->route('penanaman.index');
        }
    }

    public function edit($id)
    {
        $title = "Penanaman - Edit";
        $data = Penanaman::findOrFail($id);
        $biodata = DB::table('biodata')->where('users_id', auth()->user()->id)->first();
        $bibit = Bibit::all();
        $data = [
            'title' => $title,
            'data' => $data,
            'bibit' => $bibit,
            'biodata' => $biodata
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
            'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'tanggal' => 'required',
            'inputed_by' => 'required',
        ]);

        $penanaman = Penanaman::findOrFail($id);

        if ($request->hasFile('foto')) {
            if ($penanaman->foto) {
                Storage::delete($penanaman->foto);
            }

            $imageName = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('images'), $imageName);
            $fotoName = $imageName;
        } else {
            $fotoName = $penanaman->foto;
        }

        $penanamanUp = $penanaman->update([
            'bibit_id' => $request->bibit_id,
            'jumlah' => $request->jumlah,
            'pelaksana' => $request->pelaksana,
            'lokasi' => $request->lokasi,
            'keterangan' => $request->keterangan,
            'foto' => $fotoName,
            'tanggal' => $request->tanggal,
            'inputed_by' => $request->inputed_by,
        ]);

        if (!$penanamanUp) {
            Alert::error('Error!', 'Data penanaman gagal diperbarui.');
            return back();
        } else {
            Alert::success('Success!', 'Data penanaman berhasil diperbarui.');
            return redirect()->route('penanaman.index');
        }
    }

    public function destroy($id)
    {
        $penanaman = Penanaman::findOrFail($id);

        if ($penanaman->foto) {
            Storage::delete('images/' . $penanaman->foto);
        }

        $penanamanDel = $penanaman->delete();

        if (!$penanamanDel) {
            Alert::error('Error!', 'Data penanaman gagal dihapus.');
            return back();
        } else {
            Alert::success('Success!', 'Data penanaman berhasil dihapus.');
            return redirect()->route('penanaman.index');
        }
    }

    public function filter(Request $request)
    {
        $title = "Penanaman - filter";
        $biodata = DB::table('biodata')->where('users_id', auth()->user()->id)->first();
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        $data = Penanaman::whereDate('penanaman.tanggal', '>=', $startDate)
            ->whereDate('penanaman.tanggal', '<=', $endDate)
            ->orderby('penanaman.tanggal', 'desc')->get();

        $data = [
            'title' => $title,
            'data' => $data,
            'biodata' => $biodata
        ];
        return view('manajemen-data.kegiatan.penanaman.index', $data);
    }

    public function export()
    {
        $title = "Penanaman & Pembagian - Filter";
        $bibit = Bibit::all();
        $biodata = DB::table('biodata')->where('users_id', auth()->user()->id)->first();
        $tahun = Penanaman::select(DB::raw('YEAR(created_at) as year'))->distinct()->pluck('year');
        $bulan = [
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ];
        $data = [
            'title' => $title,
            'bibit' => $bibit,
            'biodata' => $biodata,
            'tahun' => $tahun,
            'bulan' => $bulan
        ];
        return view('manajemen-data.kegiatan.penanaman.filter', $data);
    }

    private function translateMonthToEnglish($namaBulan)
    {
        $monthNamesIndo = [
            'Januari' => 'January',
            'Februari' => 'February',
            'Maret' => 'March',
            'April' => 'April',
            'Mei' => 'May',
            'Juni' => 'June',
            'Juli' => 'July',
            'Agustus' => 'August',
            'September' => 'September',
            'Oktober' => 'October',
            'November' => 'November',
            'Desember' => 'December',
        ];

        return $monthNamesIndo[$namaBulan] ?? $namaBulan;
    }

    public function export_process(Request $request)
    {
        return Excel::download(new PenanamanPembagianExport(), 'data.xlsx');
    }
}
