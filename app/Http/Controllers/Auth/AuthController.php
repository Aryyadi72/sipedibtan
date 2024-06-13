<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Biodata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Mail\SendLink;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function index()
    {
        $title = "Login - SIPEDIBTAN";
        $data = [
            'title' => $title,
        ];
        return view('auth.login', $data);
    }

    public function register()
    {
        $title = "Register - SIPEDIBTAN";
        $data = [
            'title' => $title,
        ];
        return view('auth.register', $data);
    }

    public function authenticate(Request $request)
    {
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

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'level' => 'required',
            'inputed_by' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('register-page')->withErrors($validator)->withInput();
        }

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level' => $request->level,
            'inputed_by' => $request->inputed_by,
        ]);

        $biodata = Biodata::create([
            'nama' => $request->nama,
            'users_id' => $user->id,
        ]);

        if ($user && $biodata) {
            Alert::success('Success!', 'Registrasi berhasil, silahkan login untuk melanjutkan.');
            return redirect()->route('login');
        } else {
            Alert::error('Error!', 'Registrasi gagal, silahkan ulangi registrasi anda.');
            return redirect()->route('register-page');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function forgot_password()
    {
        $title = "Reset Password - SIPEDIBTAN";
        $data = [
            'title' => $title
        ];
        return view('auth.forgot-password', $data);
    }

    public function send_link(Request $request)
    {
        $email = $request->email;

        $user = User::where('email', $email)->first();

        if ($user) {
            $token = \Illuminate\Support\Str::random(60);

            $user->update(['remember_token' => $token]);

            Mail::to($email)->send(new SendLink($user));

            Alert::success('Success!', 'Tautan berhasil dikirmkan.');
            return redirect()->route('auth.login');
        } else {
            Alert::error('Error!', 'Email tidak ditemukan.');
            return redirect()->back();
        }
    }

    public function checkEmail(Request $request)
    {
        $exists = User::where('email', $request->email)->exists();

        return response()->json(['exists' => $exists]);
    }

    public function reset_password(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'new_password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        $user->password = Hash::make($request->new_password);
        $userSave = $user->save();

        if ($userSave) {
            Alert::success('Success!', 'Password Anda berhasil direset. Silakan login.');
            return redirect()->route('login');
        } else {
            Alert::error('Error!', 'Password Anda gagal direset. Silakan ulangi.');
            return redirect()->route('reset.index');
        }
    }
}
