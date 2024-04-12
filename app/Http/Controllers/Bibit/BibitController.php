<?php

namespace App\Http\Controllers\Bibit;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bibit;

class BibitController extends Controller
{
    public function index()
    {
        $title = "Jenis Bibit";
        $data = Bibit::all();
        $data = [
            'title' => $title,
            'data' => $data
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

    public function store(Request $request)
    {
        Bibit::create([
            'bibit' => $request->bibit,
            'inputed_by' => $request->inputed_by,
        ]);

        return redirect()->route('bibit.index');
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
        $bibit->update([
            'bibit' => $request->bibit,
        ]);

        return redirect()->route('bibit.index');
    }

    public function destroy($id)
    {
        $bibit = Bibit::find($id);

        $bibit->delete();

        return redirect()->route('bibit.index');
    }
}
