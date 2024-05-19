<?php

namespace App\Http\Controllers\Bibit;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bibit;
use DB;
use RealRashid\SweetAlert\Facades\Alert;

class BibitController extends Controller
{
    public function index()
    {
        $title = "Jenis Bibit";
        $data = Bibit::all();
        $biodata = DB::table('biodata')->where('users_id', auth()->user()->id)->first();
        $user = auth()->user();
        $totalJumlah = DB::table('bibit')
            ->leftJoin('bibit_masuk', 'bibit.id', '=', 'bibit_masuk.bibit_id')
            ->select('bibit.*', 'bibit.id as bibitid', DB::raw('COALESCE(SUM(bibit_masuk.stok), 0) as total_jumlah'))
            ->groupBy('bibit.id', 'bibit.bibit')
            ->get();
        $data = [
            'title' => $title,
            'data' => $data,
            'biodata' => $biodata,
            'user' => $user,
            'totalJumlah' => $totalJumlah
        ];
        return view('manajemen-data.bibit.bibit.index', $data);
    }

    public function create()
    {
        $title = "Bibit - Tambah";
        $data = [
            'title' => $title
        ];
        return view('manajemen-data.bibit.bibit.create', $data);
    }

    // public function store(Request $request)
    // {
    //     $bibitCreate = Bibit::create([
    //         'bibit' => $request->bibit,
    //         'inputed_by' => $request->inputed_by,
    //         'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    //     ]);

    //     if ($bibitCreate) {
    //         Alert::success('Success!', 'Data bibit berhasil ditambahkan.');
    //         return redirect()->route('bibit.index');
    //     } else {
    //         Alert::error('Error!', 'Data bibit gagal ditambahkan.');
    //         return redirect()->route('bibit.index');
    //     }
    // }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'bibit' => 'required|string|max:255',
            'inputed_by' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'keterangan' => 'required|string|max:255',
        ]);

        // Menangani unggahan gambar
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);

            // Menyimpan data bibit beserta nama file gambar
            $bibitCreate = Bibit::create([
                'bibit' => $request->bibit,
                'inputed_by' => $request->inputed_by,
                'image' => $imageName,
                'keterangan' => $request->keterangan,
            ]);

            if ($bibitCreate) {
                Alert::success('Success!', 'Data bibit berhasil ditambahkan.');
                return redirect()->route('bibit.index');
            } else {
                Alert::error('Error!', 'Data bibit gagal ditambahkan.');
                return redirect()->route('bibit.index');
            }
        } else {
            Alert::error('Error!', 'Gagal mengunggah gambar.');
            return redirect()->route('bibit.index');
        }
    }


    public function edit()
    {
        $title = "Bibit - Edit";
        $data = [
            'title' => $title
        ];
        return view('manajemen-data.bibit.bibit.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $bibit = Bibit::find($id);
        $bibitUpdate = $bibit->update([
            'bibit' => $request->bibit,
        ]);

        if ($bibitUpdate) {
            Alert::success('Success!', 'Data bibit berhasil diperbarui.');
            return redirect()->route('bibit.index');
        } else {
            Alert::error('Error!', 'Data bibit gagal diperbarui.');
            return redirect()->route('bibit.index');
        }

    }

    public function destroy($id)
    {
        $bibit = Bibit::find($id);

        $bibitDelete = $bibit->delete();

        if ($bibitDelete) {
            Alert::success('Success!', 'Data bibit berhasil dihapus.');
            return redirect()->route('bibit.index');
        } else {
            Alert::error('Error!', 'Data bibit gagal dihapus.');
            return redirect()->route('bibit.index');
        }
    }
}
