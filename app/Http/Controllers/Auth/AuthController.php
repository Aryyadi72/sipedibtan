<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Biodata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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

            if ($user->level === 'User') {
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

        Biodata::create([
            'nama' => $request->nama,
            'users_id' => $user->id,
        ]);

        // auth()->login($user);

        return redirect()->route('login')->with('success', 'Registration successful! Please login to continue.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
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

        $checkMail = User::where('email', $email)->first();

        if ($checkMail) {

        } else {

        }

        dd($checkMail);
    }
}
