<?php

namespace App\Http\Controllers\Bibit;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BibitMasuk;
use App\Models\Bibit;
use DB;

class BibitMasukController extends Controller
{
    public function index()
    {
        $title = "Bibit Masuk";
        $data = BibitMasuk::all();
        $bibit = Bibit::all();
        $biodata = DB::table('biodata')->where('users_id', auth()->user()->id)->first();
        $data = [
            'title' => $title,
            'data' => $data,
            'bibit' => $bibit,
            'biodata' => $biodata
        ];
        return view('manajemen-data.bibit.bibit-masuk.index', $data);
    }

    public function create()
    {
        $title = "Bibit Masuk - Tambah";
        $data = [
            'title' => $title,
        ];
        return view('manajemen-data.bibit.bibit-masuk.create', $data);
    }

    public function store(Request $request)
    {
        BibitMasuk::create([
            'bibit_id' => $request->bibit_id,
            'stok' => $request->stok,
            'inputed_by' => $request->inputed_by,
        ]);

        return redirect()->route('bibit-masuk.index');
    }

    public function edit()
    {
        $title = "Bibit Masuk - Edit";
        $data = [
            'title' => $title
        ];
        return view('manajemen-data.bibit.bibit-masuk.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $bibit = BibitMasuk::find($id);
        $bibit->update([
            'bibit_id' => $request->bibit_id,
            'stok' => $request->stok,
        ]);

        return redirect()->route('bibit-masuk.index');
    }

    public function destroy($id)
    {
        $bibit = BibitMasuk::find($id);

        $bibit->delete();

        return redirect()->route('bibit-masuk.index');
    }
}
