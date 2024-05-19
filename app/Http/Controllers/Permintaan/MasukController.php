<?php

namespace App\Http\Controllers\Permintaan;

use App\Http\Controllers\Controller;
use App\Models\PermintaanMasuk;
use Illuminate\Http\Request;
use App\Models\Bibit;
use App\Models\BibitKeluar;
use App\Models\BibitMasuk;
use DB;
use Carbon\Carbon;

class MasukController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $userId = $user->id;

        if ($user->level == 'Masyarakat') {
            $title = "Permintaan Bibit - SIPEDIBTAN";
            $totalAll = PermintaanMasuk::where('users_id', $userId)->count();
            $totalMasuk = PermintaanMasuk::where('users_id', $userId)->where('status', 'Masuk')->count();
            $totalSelesai = PermintaanMasuk::where('users_id', $userId)->where('status', 'Selesai')->count();
            $totalBatal = PermintaanMasuk::where('users_id', $userId)->where('status', 'Batal')->count();
            $biodata = DB::table('biodata')->where('users_id', auth()->user()->id)->first();
            $datapm = DB::table('permintaan_masuk')
                ->join('bibit', 'permintaan_masuk.bibit_id', '=', 'bibit.id')
                ->join('users', 'permintaan_masuk.users_id', '=', 'users.id')
                // ->join('permintaan_keluar', 'permintaan_masuk.id', '=', 'permintaan_keluar.permintaan_masuk_id')
                ->join('biodata', 'users.id', '=', 'biodata.users_id')
                ->select('permintaan_masuk.*', 'bibit.*', 'permintaan_masuk.id as masuk_id', 'permintaan_masuk.created_at as masuk_tgl', 'biodata.nama as nama_user')
                ->where('permintaan_masuk.users_id', $userId)
                ->orderby('permintaan_masuk.created_at', 'desc')
                ->get();
            // dd($datapm, $userId, $biodata);
            $bibit = Bibit::all();
            $data = [
                'title' => $title,
                'biodata' => $biodata,
                'bibit' => $bibit,
                'totalAll' => $totalAll,
                'totalMasuk' => $totalMasuk,
                'totalSelesai' => $totalSelesai,
                'totalBatal' => $totalBatal,
                'datapm' => $datapm
            ];
            return view('permintaan.masuk.index-masyarakat', $data);
        } else {
            $title = "Permintaan Masuk - SIPEDIBTAN";
            $biodata = DB::table('biodata')->where('users_id', auth()->user()->id)->first();
            $datapm = DB::table('permintaan_masuk')
                ->join('bibit', 'permintaan_masuk.bibit_id', '=', 'bibit.id')
                ->join('users', 'permintaan_masuk.users_id', '=', 'users.id')
                ->join('biodata', 'users.id', '=', 'biodata.users_id')
                ->select('permintaan_masuk.*', 'bibit.*', 'users.*', 'biodata.*', 'permintaan_masuk.id as masuk_id', 'permintaan_masuk.created_at as masuk_tgl')
                ->where('permintaan_masuk.status', 'Masuk')
                ->orderby('permintaan_masuk.created_at', 'desc')
                ->get();
            $bibit = Bibit::all();
            $data = [
                'title' => $title,
                'biodata' => $biodata,
                'bibit' => $bibit,
                'datapm' => $datapm

            ];
            return view('permintaan.masuk.index', $data);
        }

    }

    public function create()
    {
        $title = "Tambah Permintaan Masuk - SIPEDIBTAN";
        $biodata = DB::table('biodata')->where('users_id', auth()->user()->id)->first();
        $data = [
            'title' => $title,
            'biodata' => $biodata
        ];
        return view('permintaan.masuk.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'users_id' => 'required',
            'bibit_id' => 'required',
            'jumlah' => 'required',
            'status' => 'required',
            'inputed_by' => 'required',
        ]);

        BibitKeluar::create([
            'bibit_id' => $request->bibit_id,
            'jumlah' => $request->jumlah,
            'tanggal' => Carbon::today()->toDateString(),
            'inputed_by' => $request->inputed_by,
            'keterangan' => 'Permintaan'
        ]);

        PermintaanMasuk::create([
            'users_id' => $request->users_id,
            'bibit_id' => $request->bibit_id,
            'jumlah' => $request->jumlah,
            'status' => $request->status,
        ]);

        return redirect()->route('masuk.index')->with('success', 'Data penanaman berhasil disimpan.');
    }


    public function edit()
    {
        $title = "Edit Permintaan Masuk - SIPEDIBTAN";
        $biodata = DB::table('biodata')->where('users_id', auth()->user()->id)->first();
        $data = [
            'title' => $title,
            'biodata' => $biodata
        ];
        return view('permintaan.masuk.edit', $data);
    }

    public function filter(Request $request)
    {
        $user = auth()->user();
        $userId = $user->id;

        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $bibitId = $request->bibit_id;
        $status = $request->status;

        $title = "Permintaan Bibit - SIPEDIBTAN";
        $totalAll = PermintaanMasuk::where('users_id', $userId)->count();
        $totalMasuk = PermintaanMasuk::where('users_id', $userId)->where('status', 'Masuk')->count();
        $totalSelesai = PermintaanMasuk::where('users_id', $userId)->where('status', 'Selesai')->count();
        $totalBatal = PermintaanMasuk::where('users_id', $userId)->where('status', 'Batal')->count();
        $biodata = DB::table('biodata')->where('users_id', auth()->user()->id)->first();
        $datapm = DB::table('permintaan_masuk')
            ->join('bibit', 'permintaan_masuk.bibit_id', '=', 'bibit.id')
            ->join('users', 'permintaan_masuk.users_id', '=', 'users.id')
            ->join('biodata', 'users.id', '=', 'biodata.users_id')
            ->join('permintaan_keluar', 'permintaan_masuk.id', '=', 'permintaan_keluar.permintaan_masuk_id')
            ->select('permintaan_masuk.*', 'permintaan_keluar.*', 'bibit.*', 'users.*', 'biodata.*', 'permintaan_masuk.id as masuk_id', 'permintaan_masuk.created_at as masuk_tgl')
            ->where('permintaan_masuk.users_id', $userId)
            ->where('permintaan_masuk.bibit_id', $bibitId)
            ->where('permintaan_masuk.status', $status)
            ->whereDate('permintaan_masuk.created_at', '>=', $startDate)
            ->whereDate('permintaan_masuk.created_at', '<=', $endDate)
            ->orderby('permintaan_masuk.created_at', 'desc')
            ->get();
        $bibit = Bibit::all();

        $data = [
            'title' => $title,
            'biodata' => $biodata,
            'bibit' => $bibit,
            'totalAll' => $totalAll,
            'totalMasuk' => $totalMasuk,
            'totalSelesai' => $totalSelesai,
            'totalBatal' => $totalBatal,
            'datapm' => $datapm
        ];
        return view('permintaan.masuk.index-masyarakat', $data);

        // dd($startDate, $endDate, $bibitId, $status, $datapm);
    }

    public function filter_adm(Request $request)
    {
        $title = "Permintaan Masuk - SIPEDIBTAN";
        $biodata = DB::table('biodata')->where('users_id', auth()->user()->id)->first();
        $bibit = Bibit::all();
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $datapm = DB::table('permintaan_masuk')
            ->join('bibit', 'permintaan_masuk.bibit_id', '=', 'bibit.id')
            ->join('users', 'permintaan_masuk.users_id', '=', 'users.id')
            ->join('biodata', 'users.id', '=', 'biodata.users_id')
            ->select('permintaan_masuk.*', 'bibit.*', 'users.*', 'biodata.*', 'permintaan_masuk.id as masuk_id', 'permintaan_masuk.created_at as masuk_tgl')
            ->where('permintaan_masuk.status', 'Masuk')
            ->whereDate('permintaan_masuk.created_at', '>=', $startDate)
            ->whereDate('permintaan_masuk.created_at', '<=', $endDate)
            ->orderby('permintaan_masuk.created_at', 'desc')
            ->get();

        $data = [
            'title' => $title,
            'biodata' => $biodata,
            'bibit' => $bibit,
            'datapm' => $datapm
        ];
        return view('permintaan.masuk.index', $data);
    }

    public function filter_adm_selesai(Request $request)
    {
        $title = "Permintaan Selesai - SIPEDIBTAN";
        $biodata = DB::table('biodata')->where('users_id', auth()->user()->id)->first();
        $bibit = Bibit::all();
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $datapk = DB::table('permintaan_keluar')
            ->join('users', 'permintaan_keluar.users_id', '=', 'users.id')
            ->join('permintaan_masuk', 'permintaan_keluar.permintaan_masuk_id', '=', 'permintaan_masuk.id')
            ->join('bibit', 'permintaan_masuk.bibit_id', '=', 'bibit.id')
            ->join('biodata', 'users.id', '=', 'biodata.users_id')
            ->select('permintaan_keluar.*', 'permintaan_masuk.*', 'bibit.*', 'users.*', 'biodata.*', 'permintaan_keluar.id as keluar_id', 'permintaan_keluar.created_at as keluar_tgl')
            ->where('permintaan_masuk.status', 'Selesai')
            ->whereDate('permintaan_masuk.created_at', '>=', $startDate)
            ->whereDate('permintaan_masuk.created_at', '<=', $endDate)
            ->orderby('permintaan_keluar.created_at', 'desc')
            ->get();

        $data = [
            'title' => $title,
            'biodata' => $biodata,
            'bibit' => $bibit,
            'datapk' => $datapk
        ];
        return view('permintaan.keluar.index', $data);
    }

    public function filter_adm_batal(Request $request)
    {
        $title = "Permintaan Batal - SIPEDIBTAN";
        $biodata = DB::table('biodata')->where('users_id', auth()->user()->id)->first();
        $bibit = Bibit::all();
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $datapb = DB::table('permintaan_keluar')
            ->join('users', 'permintaan_keluar.users_id', '=', 'users.id')
            ->join('permintaan_masuk', 'permintaan_keluar.permintaan_masuk_id', '=', 'permintaan_masuk.id')
            ->join('bibit', 'permintaan_masuk.bibit_id', '=', 'bibit.id')
            ->join('biodata', 'users.id', '=', 'biodata.users_id')
            ->select('permintaan_keluar.*', 'permintaan_masuk.*', 'bibit.*', 'users.*', 'biodata.*', 'permintaan_keluar.id as keluar_id', 'permintaan_keluar.created_at as keluar_tgl')
            ->where('permintaan_masuk.status', 'Batal')
            ->whereDate('permintaan_masuk.created_at', '>=', $startDate)
            ->whereDate('permintaan_masuk.created_at', '<=', $endDate)
            ->orderby('permintaan_keluar.created_at', 'desc')
            ->get();

        $data = [
            'title' => $title,
            'biodata' => $biodata,
            'bibit' => $bibit,
            'datapb' => $datapb
        ];
        return view('permintaan.ditolak.index', $data);
    }
}
