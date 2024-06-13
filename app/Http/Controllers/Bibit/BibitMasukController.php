<?php

namespace App\Http\Controllers\Bibit;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BibitMasuk;
use App\Models\Bibit;
use DB;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;

class BibitMasukController extends Controller
{
    public function index()
    {
        $title = "Bibit Masuk";
        $data = BibitMasuk::orderby('bibit_masuk.created_at', 'desc')->get();
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
        $user = auth()->user();
        $level = $user->level;
        $now = Carbon::now()->tz('Asia/Jakarta');

        if ($request->stok < 1) {
            Alert::error('Error!', 'Data bibit masuk gagal ditambahkan.');
            return redirect()->route('bibit-masuk.index');
        } else {
            $bmadd = BibitMasuk::create([
                'bibit_id' => $request->bibit_id,
                'stok' => $request->stok,
                'inputed_by' => $level,
                'created_at' => $now
            ]);

            if ($bmadd) {
                Alert::success('Success!', 'Data bibit masuk berhasil ditambahkan.');
                return redirect()->route('bibit-masuk.index');
            } else {
                Alert::error('Error!', 'Data bibit masuk gagal ditambahkan.');
                return redirect()->route('bibit-masuk.index');
            }
        }
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
        $bmup = $bibit->update([
            'bibit_id' => $request->bibit_id,
            'stok' => $request->stok,
        ]);

        if ($bmup) {
            Alert::success('Success!', 'Data bibit masuk berhasil diperbarui.');
            return redirect()->route('bibit-masuk.index');
        } else {
            Alert::error('Error!', 'Data bibit masuk gagal diperbarui.');
            return redirect()->route('bibit-masuk.index');
        }
    }
    public function destroy($id)
    {
        $bibit = BibitMasuk::find($id);

        $bmdel = $bibit->delete();

        if ($bmdel) {
            Alert::success('Success!', 'Data bibit masuk berhasil dihapus.');
            return redirect()->route('bibit-masuk.index');
        } else {
            Alert::error('Error!', 'Data bibit masuk gagal dihapus.');
            return redirect()->route('bibit-masuk.index');
        }

    }

    public function filter(Request $request)
    {
        $title = "Bibit Masuk";
        $biodata = DB::table('biodata')->where('users_id', auth()->user()->id)->first();
        $bibit = Bibit::all();
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        $data = BibitMasuk::whereDate('bibit_masuk.created_at', '>=', $startDate)
            ->whereDate('bibit_masuk.created_at', '<=', $endDate)
            ->orderby('bibit_masuk.created_at', 'desc')->get();

        $data = [
            'title' => $title,
            'data' => $data,
            'bibit' => $bibit,
            'biodata' => $biodata
        ];
        return view('manajemen-data.bibit.bibit-masuk.index', $data);
    }
}
