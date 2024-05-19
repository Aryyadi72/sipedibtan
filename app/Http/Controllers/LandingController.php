<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bibit;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\PermintaanMasuk;

class LandingController extends Controller
{
    public function index()
    {
        // $bibit = Bibit::orderby('bibit.bibit', 'asc')->get();
        $bibit = DB::table('bibit')
            ->leftJoin('bibit_masuk', 'bibit.id', '=', 'bibit_masuk.bibit_id')
            ->select('bibit.*', 'bibit.id as bibitid', DB::raw('COALESCE(SUM(bibit_masuk.stok), 0) as total_jumlah'))
            ->groupBy('bibit.id', 'bibit.bibit')
            ->orderby('bibit.bibit', 'asc')
            ->get();
        // dd($bibit);
        $bibitTersedia = DB::table('bibit')
            ->leftJoin('bibit_masuk', 'bibit.id', '=', 'bibit_masuk.bibit_id')
            ->select('bibit.*', 'bibit.id as bibitid', DB::raw('COALESCE(SUM(bibit_masuk.stok), 0) as total_jumlah'))
            ->where('bibit_masuk.stok', '>', 0)
            ->groupBy('bibit.id', 'bibit.bibit')
            ->orderby('bibit.bibit', 'asc')
            ->get();
        $bibitTidakTersedia = DB::table('bibit')
            ->leftJoin('bibit_masuk', 'bibit.id', '=', 'bibit_masuk.bibit_id')
            ->select('bibit.*', 'bibit.id as bibitid', DB::raw('COALESCE(SUM(bibit_masuk.stok), 0) as total_jumlah'))
            ->where('bibit_masuk.stok', null)
            ->groupBy('bibit.id', 'bibit.bibit')
            ->orderby('bibit.bibit', 'asc')
            ->get();
        $data = [
            'bibit' => $bibit,
            'bibitTersedia' => $bibitTersedia,
            'bibitTidakTersedia' => $bibitTidakTersedia
        ];
        return view('landing', $data);
    }

    public function submitRequest(Request $request)
    {
        $bibitId = $request->bibit_id;
        $jumlah = $request->jumlah;
        $status = $request->status;
        $email = $request->email;
        $password = $request->password;

        $user = User::where('email', $email)->first();

        if (!$user || !Hash::check($password, $user->password)) {
            return redirect()->back()->with('error', 'Email atau password salah.');
        }

        $requestModel = new PermintaanMasuk();
        $requestModel->users_id = $user->id;
        $requestModel->bibit_id = $bibitId;
        $requestModel->jumlah = $jumlah;
        $requestModel->status = $status;
        $requestModel->save();

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->level === 'Masyarakat') {
                return redirect()->route('masuk.index');
            } else {
                $request->session()->regenerate();
                return redirect()->intended('/dashboard');
            }
        }
    }
}
